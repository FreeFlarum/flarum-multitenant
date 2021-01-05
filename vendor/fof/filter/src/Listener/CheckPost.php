<?php

/*
 * This file is part of fof/filter.
 *
 * Copyright (c) 2020 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the license.md
 * file that was distributed with this source code.
 */

namespace FoF\Filter\Listener;

use Flarum\Flags\Flag;
use Flarum\Post\Event\Saving;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Symfony\Component\Translation\TranslatorInterface;

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

    public function __construct(SettingsRepositoryInterface $settings, TranslatorInterface $translator, Mailer $mailer)
    {
        $this->settings = $settings;
        $this->translator = $translator;
        $this->mailer = $mailer;
    }

    public function handle(Saving $event)
    {
        if (!$event->post->exists) {
            return;
        }

        $post = $event->post;

        if ($post->auto_mod) {
            return;
        }

        if ($this->checkContent($post->content)) {
            $this->flagPost($post);
            if ($this->settings->get('fof-filter.emailWhenFlagged') == 1 && $post->emailed == 0) {
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

    public function flagPost($post): void
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

    public function sendEmail($post): void
    {
        // Admin hasn't saved an email template to the database
        if ($this->settings->get('flaggedSubject') == '' && $this->settings->get('flaggedEmail') == '') {
            $this->settings->set(
                'flaggedSubject',
                $this->translator->trans('fof-filter.admin.email.default_subject')
            );
            $this->settings->set(
                'flaggedEmail',
                $this->translator->trans('fof-filter.admin.email.default_text')
            );
        }
        $email = $post->user->email;
        $linebreaks = ["\n", "\r\n"];
        $subject = $this->settings->get('flaggedSubject');
        $text = str_replace($linebreaks, $post->user->username, $this->settings->get('flaggedEmail'));
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
