<?php

/*
 * This file is part of askvortsov/flarum-help-tags
 *
 *  Copyright (c) 2020 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumHelpTags\Access;

use Flarum\Tags\Tag;
use Flarum\User\User;
use Illuminate\Database\Eloquent\Builder;

class ScopeTagVisibility
{
    /**
     * @param User    $actor
     * @param Builder $query
     */
    public function __invoke(User $actor, Builder $query)
    {
        $query
            ->orWhereIn('id', Tag::getIdsWhereCan($actor, 'startDiscussion'))
            ->orWhereIn('id', Tag::getIdsWhereCan($actor, 'discussion.viewTag'))
            ->orWhereIn('id', Tag::getIdsWhereCan($actor, 'viewTag'));
    }
}
