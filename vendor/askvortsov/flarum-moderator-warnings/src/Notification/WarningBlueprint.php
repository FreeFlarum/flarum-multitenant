<?php

/*
 * This file is part of askvortsov/flarum-moderator-warnings
 *
 *  Copyright (c) 2020 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumWarnings\Notification;

use Askvortsov\FlarumWarnings\Model\Warning;
use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\Notification\MailableInterface;

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
    public function getEmailSubject()
    {
        $result = "{$this->warning->addedByUser->display_name} warned you with {$this->warning->strikes} strikes";
        if ($this->warning->post_id != null) {
            $result .= " in {$this->warning->post->discussion->title}";
        }

        return $result;
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
