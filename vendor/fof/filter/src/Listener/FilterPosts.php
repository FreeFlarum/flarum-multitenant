<?php
/**
 *  This file is part of fof/filter.
 *
 *  Copyright (c) 2020 FriendsOfFlarum..
 *
 *  For the full copyright and license information, please view the license.md
 *  file that was distributed with this source code.
 */

namespace FoF\Filter\Listener;

use Flarum\Flags\Flag;
use Flarum\Foundation\Application;
use Flarum\Post\CommentPost;
use Flarum\Post\Event\Posted;
use Flarum\Post\Event\Saving;
use Flarum\Post\PostRepository;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Symfony\Component\Translation\TranslatorInterface;

class FilterPosts
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;
    /**
     * @var Application
     */
    protected $app;
    /**
     * @var Mailer
     */
    protected $mailer;
    /**
     * @var TranslatorInterface
     */
    protected $translator;
    /**
     * @var PostRepository
     */
    protected $posts;

    /**
     * @param SettingsRepositoryInterface $settings
     * @param Application                 $app
     * @param TranslatorInterface         $translator
     * @param Mailer                      $mailer
     * @param PostRepository              $posts
     */
    public function __construct(
        SettingsRepositoryInterface $settings,
        Mailer $mailer,
        Application $app,
        TranslatorInterface $translator,
        PostRepository $posts
    ) {
        $this->settings = $settings;
        $this->app = $app;
        $this->mailer = $mailer;
        $this->translator = $translator;
        $this->posts = $posts;
    }

    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Saving::class, [$this, 'checkPost']);
        $events->listen(Posted::class, [$this, 'mergePost']);
    }

    /**
     * @param Saving $event
     */
    public function checkPost(Saving $event)
    {
        $post = $event->post;

        if ($post->auto_mod) {
            return;
        }

        if ($this->checkContent($post->content)) {
            $this->flagPost($post);
            if ($this->settings->get('emailWhenFlagged') == 1 && $post->emailed == 0) {
                $this->sendEmail($post);
            }
        }
    }

    public function mergePost(Posted $event)
    {
        $post = $event->post;

        if ($post instanceof CommentPost && $post->number !== 1 && !$post->auto_mod && $this->settings->get('fof-filter.autoMergePosts') === '1') {
            $oldPost = $this->posts->query()
                ->where('discussion_id', '=', $post->discussion_id)
                ->where('number', '<', $post->number)
                ->where('hidden_at', '=', null)
                ->orderBy('number', 'desc')
                ->firstOrFail();

            $cooldown = $this->settings->get('fof-filter.cooldown') || '15';

            if ($oldPost->user_id == $post->user_id && strtotime($oldPost) < strtotime("-$cooldown minutes")) {
                $oldPost->revise($oldPost->content.'
                
'.$post->content, $post->user);

                $oldPost->save();

                $post->delete();
            }
        }
    }

    public function checkContent($postContent)
    {
        $censors = json_decode($this->settings->get('fof-filter.censors'), true);

        $isExplicit = false;

        preg_replace_callback(
            $censors,
            function ($matches) use (&$isExplicit) {
                if ($matches) {
                    $isExplicit = true;
                }
            },
            str_replace(' ', '', $postContent)
        );

        return $isExplicit;
    }

    public function flagPost($post)
    {
        $post->is_approved = false;
        $post->auto_mod = true;
        $post->afterSave(function ($post) {
            if ($post->number == 1) {
                $post->discussion->is_approved = false;
                $post->discussion->save();
            }
            $flag = new Flag();
            $flag->post_id = $post->id;
            $flag->type = $this->translator->trans('fof-filter.forum.flagger_name');
            $flag->reason = $this->translator->trans('fof-filter.forum.flag_message');
            $flag->created_at = time();
            $flag->save();
        });
    }

    public function sendEmail($post)
    {
        // Admin hasn't saved an email template to the database
        if ($this->settings->get('flaggedSubject') == '' && $this->settings->get('flaggedEmail') == '') {
            $this->settings->set('flaggedSubject',
                $this->translator->trans('fof-filter.admin.email.default_subject'));
            $this->settings->set('flaggedEmail',
                $this->translator->trans('fof-filter.admin.email.default_text'));
        }
        $email = $post->user->email;
        $linebreaks = ["\n", "\r\n"];
        $subject = $this->settings->get('flaggedSubject');
        $text = str_replace($linebreaks, $post->user->username, $this->settings->get('flaggedEmail'));
        $this->mailer->send('fof-filter::default', ['text' => $text],
            function (Message $message) use ($subject, $email) {
                $message->to($email);
                $message->subject($subject);
            });
        $post->emailed = true;
    }
}
