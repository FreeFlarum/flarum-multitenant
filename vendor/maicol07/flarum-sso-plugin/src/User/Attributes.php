<?php

namespace Maicol07\SSO\User;

/**
 * Class Attributes
 * @package Maicol07\SSO\User
 */
class Attributes
{
    /** @var string */
    public $username;

    /** @var string */
    public $email;

    /** @var string|null */
    public $password;

    /**
     * WARNING! This is read only! Overwriting this when updating the user won't do anything!
     * To change the display name use the $nickname variable (beta16+. Nickname extension required).
     *
     * @var string
     * @see $nickname
     */
    public $displayName;

    /**
     * WARNING! This is write only! To read this attribute use the $displayName property.
     * To change the nickname you must have the nickname extension installed on your Flarum.
     *
     * @var string
     */
    public $nickname;

    /** @var string */
    public $avatarUrl;

    /** @var string */
    public $joinTime;

    /** @var int */
    public $discussionCount;

    /** @var int */
    public $commentCount;

    /** @var bool */
    public $canEdit;

    /** @var bool */
    public $canDelete;

    /** @var bool */
    public $canSuspend;

    /** @var string */
    public $bio;

    /** @var bool */
    public $canViewBio;

    /** @var bool */
    public $canEditBio;

    /** @var bool */
    public $canSpamblock;

    /** @var bool */
    public $blocksPd;

    /** @var bool */
    public $cannotBeDirectMessaged;

    /** @var bool */
    public $isBanned;

    /** @var bool */
    public $canBandIP;

    /** @var array */
    public $usernameHistory;

    /** @var bool */
    public $canViewWarnings;

    /** @var bool */
    public $canManageWarnings;

    /** @var bool */
    public $canDeleteWarnings;

    /** @var int */
    public $visibleWarningCount;


    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
