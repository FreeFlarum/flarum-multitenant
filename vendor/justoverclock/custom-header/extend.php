<?php

/*
 * This file is part of justoverclock/custom-header.
 *
 * Copyright (c) 2021 Marco Colia.
 * https://flarum.it
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Justoverclock\CustomHeader;

use Flarum\Extend;
use Flarum\Api\Event\Serializing;


return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),
    new Extend\Locales(__DIR__.'/resources/locale'),
    (new Extend\Settings)
        ->serializeToForum('justoverclock-custom-header.headerBackgroundImage', 'justoverclock-custom-header.headerBackgroundImage')
        ->serializeToForum('headerTitle', 'justoverclock-custom-header.headerTitle'),
    (new Extend\Settings)
        ->serializeToForum('headerTagline', 'justoverclock-custom-header.headerTagline'),
    (new Extend\Settings)
        ->serializeToForum('twitterIcon', 'justoverclock-custom-header.twitterIcon'),
    (new Extend\Settings)
        ->serializeToForum('facebookIcon', 'justoverclock-custom-header.facebookIcon'),
    (new Extend\Settings)
        ->serializeToForum('youtubeIcon', 'justoverclock-custom-header.youtubeIcon'),
    (new Extend\Settings)
        ->serializeToForum('githubIcon', 'justoverclock-custom-header.githubIcon'),
    (new Extend\Settings)
        ->serializeToForum('buttonText', 'justoverclock-custom-header.buttonText'),
    (new Extend\Settings)
        ->serializeToForum('button2Text', 'justoverclock-custom-header.button2Text'),
    (new Extend\Settings)
        ->serializeToForum('LinkButtonOne', 'justoverclock-custom-header.LinkButtonOne'),
    (new Extend\Settings)
        ->serializeToForum('LinkButtonTwo', 'justoverclock-custom-header.LinkButtonTwo'),
];
