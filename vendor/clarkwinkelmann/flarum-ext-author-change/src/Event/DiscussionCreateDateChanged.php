<?php

namespace ClarkWinkelmann\AuthorChange\Event;

use Carbon\Carbon;
use Flarum\Discussion\Discussion;
use Flarum\User\User;

/**
 * The creation date of a discussion was modified.
 * @property Discussion $discussion
 * @property Carbon|null $oldDate Previous creation date
 * @property User|null $actor Actor who performed the change
 */
class DiscussionCreateDateChanged
{
    public $discussion;
    public $oldDate;
    public $actor;

    public function __construct(Discussion $discussion, Carbon $oldDate, User $actor = null)
    {
        $this->discussion = $discussion;
        $this->oldDate = $oldDate;
        $this->actor = $actor;
    }
}
