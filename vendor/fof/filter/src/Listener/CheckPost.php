<?php

/*
 * This file is part of fof/filter.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Filter\Listener;

use Flarum\Flags\Event\Created;
use Flarum\Flags\Flag;
use Flarum\Post\Event\Saving;
use Flarum\Post\Post;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\Guest;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Symfony\Contracts\Translation\TranslatorInterface;

class CheckPost
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var Mailer
     */
    protected $mailer;

    /**
     * @var Dispatcher
     */
    protected $bus;

    public function __construct(SettingsRepositoryInterface $settings, TranslatorInterface $translator, Mailer $mailer, Dispatcher $bus)
    {
        $this->settings = $settings;
        $this->translator = $translator;
        $this->mailer = $mailer;
        $this->bus = $bus;
    }

    public function handle(Saving $event)
    {
        $post = $event->post;

        if ($post->auto_mod || $event->actor->can('bypassFoFFilter', $post->discussion)) {
            return;
        }

        if ($this->checkContent($post->content)) {
            $this->flagPost($post);

            if ((bool) $this->settings->get('fof-filter.emailWhenFlagged') && $post->emailed == 0) {
                $this->sendEmail($post);
            }
        }
    }

    public function checkContent($postContent): bool
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

    public function flagPost(Post $post): void
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
            $flag->type = 'autoMod';
            $flag->reason_detail = $this->translator->trans('fof-filter.forum.flag_message');
            $flag->created_at = time();
            $flag->save();

            $this->bus->dispatch(new Created($flag, new Guest()));
        });
    }

    public function sendEmail($post): void
    {
        // Admin hasn't saved an email template to the database
        if (empty($this->settings->get('fof-filter.flaggedSubject'))) {
            $this->settings->set(
                'fof-filter.flaggedSubject',
                $this->translator->trans('fof-filter.admin.email.default_subject')
            );
        }

        if (empty($this->settings->get('fof-filter.flaggedEmail'))) {
            $this->settings->set(
                'fof-filter.flaggedEmail',
                $this->translator->trans('fof-filter.admin.email.default_text')
            );
        }

        $email = $post->user->email;
        $linebreaks = ["\n", "\r\n"];
        $subject = $this->settings->get('fof-filter.flaggedSubject');
        $text = str_replace($linebreaks, $post->user->username, $this->settings->get('fof-filter.flaggedEmail'));
        $this->mailer->send(
            'fof-filter::default',
            ['text' => $text],
            function (Message $message) use ($subject, $email) {
                $message->to($email);
                $message->subject($subject);
            }
        );
        $post->emailed = true;
    }
}
