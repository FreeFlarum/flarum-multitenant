<?php

/*
 * This file is part of fof/prevent-necrobumping.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\PreventNecrobumping;

use Flarum\Api\Serializer\DiscussionSerializer;
use Flarum\Extend as Vanilla;
use Flarum\Post\Event\Saving;
use FoF\Extend\Extend;

return [
    (new Vanilla\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),

    (new Vanilla\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),

    new Vanilla\Locales(__DIR__.'/resources/locale'),

    (new Extend\ExtensionSettings())
        ->setPrefix('fof-prevent-necrobumping.')
        ->addKeys(['message.title', 'message.description', 'message.agreement']),

    (new Vanilla\Event())
        ->listen(Saving::class, Listeners\ValidateNecrobumping::class),

    (new Vanilla\ApiSerializer(DiscussionSerializer::class))
        ->attributes(Listeners\AddForumAttributes::class),
];
