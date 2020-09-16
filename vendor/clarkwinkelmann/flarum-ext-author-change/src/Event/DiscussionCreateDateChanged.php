<?php

namespace ClarkWinkelmann\AuthorChange\Event;

use Carbon\Carbon;
use Flarum\Discussion\Discussion;

class DiscussionCreateDateChanged
{
    public $discussion;
    public $oldDate;

    public function __construct(Discussion $discussion, Carbon $oldDate)
    {
        $this->discussion = $discussion;
        $this->oldDate = $oldDate;
    }
}
