<?php

/*
 * This file is part of askvortsov/flarum-help-tags
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
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
    public function __invoke(User $actor, Builder $query)
    {
        $query
            ->orWhereIn('id', Tag::whereHasPermission($actor, 'startDiscussion')->select('tags.id'))
            ->orWhereIn('id', Tag::whereHasPermission($actor, 'viewTag')->select('tags.id'));
    }
}
