<?php

/*
 * This file is part of justoverclock/flarum-ext-socialcards.
 *
 * Copyright (c) 2021 Marco Colia.
 * https://flarum.it
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Justoverclock\SocialCards;


use Flarum\Extend;
use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Api\Event\Serializing;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),
    new Extend\Locales(__DIR__.'/resources/locale'),
    (new Extend\Settings())->serializeToForum('ShowFacebook', 'justoverclock-socialcards.hide.facebook', 'boolval', false),
    (new Extend\Settings())->serializeToForum('ShowYoutube', 'justoverclock-socialcards.hide.youtube', 'boolval', false),
    (new Extend\Settings())->serializeToForum('ShowTwitter', 'justoverclock-socialcards.hide.twitter', 'boolval', false),
    (new Extend\Settings())->serializeToForum('ShowGithub', 'justoverclock-socialcards.hide.github', 'boolval', false),
    (new Extend\Settings())->serializeToForum('fblink', 'justoverclock-guestengagement.fblink'),
    (new Extend\Settings())->serializeToForum('ytlink', 'justoverclock-guestengagement.ytlink'),
    (new Extend\Settings())->serializeToForum('twlink', 'justoverclock-guestengagement.twlink'),
    (new Extend\Settings())->serializeToForum('ghlink', 'justoverclock-guestengagement.ghlink'),
];
