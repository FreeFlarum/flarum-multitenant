<?php

/*
 * This file is part of afrux/top-posters-widget.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Afrux\TopPosters;

use Flarum\Api\Serializer as FlarumSerializer;
use Flarum\Api\Controller\ShowForumController;
use Flarum\Extend;
use Flarum\User\Filter\UserFilterer;
use Flarum\User\Search\UserSearcher;
use Flarum\User\User;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\ApiSerializer(FlarumSerializer\ForumSerializer::class))
        ->attributes(AddTopPostersToApi::class)
        ->hasMany('topPosters', FlarumSerializer\UserSerializer::class),

    (new Extend\ApiController(ShowForumController::class))
        ->addInclude(['topPosters'])
        ->prepareDataForSerialization(LoadForumTopPostersRelationship::class),

    (new Extend\Filter(UserFilterer::class))
        ->addFilter(Query\TopPosterGambitFilter::class),

    (new Extend\SimpleFlarumSearch(UserSearcher::class))
        ->addGambit(Query\TopPosterGambitFilter::class),
];
