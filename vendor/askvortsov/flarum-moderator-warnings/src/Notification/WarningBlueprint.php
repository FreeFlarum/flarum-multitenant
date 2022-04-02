<?php

/*
 * This file is part of askvortsov/flarum-moderator-warnings
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumWarnings\Notification;

use Askvortsov\FlarumWarnings\Model\Warning;
use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\Notification\MailableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class WarningBlueprint implements BlueprintInterface, MailableInterface
{
    /**
     * @var Warning
     */
    public $warning;

    /**
     * @param Warning $post
     */
    public function __construct(Warning $warning)
    {
        $this->warning = $warning;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubject()
    {
        return $this->warning;
    }

    /**
     * {@inheritdoc}
     */
    public function getFromUser()
    {
        return $this->warning->addedByUser;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getEmailView()
    {
        return ['text' => 'askvortsov-moderator-warnings::emails.warning'];
    }

    /**
     * {@inheritdoc}
     */
    public function getEmailSubject(TranslatorInterface $translator)
    {
        return $translator->trans($this->getTranslation().'.subject', [
            '{warner_display_name}' => $this->warning->addedByUser->display_name,
            '{strikes}'             => $this->warning->strikes,
            '{discussion_title}'    => $this->warning->post ? $this->warning->post->discussion->title : '',
        ]);
    }

    public function getTranslation()
    {
        return 'askvortsov-moderator-warnings.emails.'.($this->warning->post_id ? 'post_warned' : 'user_warned');
    }

    public function getUnparsedComment()
    {
        return Warning::getFormatter()->unparse($this->warning->public_comment);
    }

    /**
     * {@inheritdoc}
     */
    public static function getType()
    {
        return 'warning';
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubjectModel()
    {
        return Warning::class;
    }
}
