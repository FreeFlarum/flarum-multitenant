<?php

/*
 * This file is part of justoverclock/flarum-ext-dontgoaway.
 *
 * Copyright (c) 2021 Marco Colia.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Justoverclock\DontGoAway;

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
    (new Extend\Settings)
        ->serializeToForum('ModalTitle', 'justoverclock-dontgoaway.modaltitle'),
    (new Extend\Settings)
        ->serializeToForum('ModalText', 'justoverclock-dontgoaway.ModalText'),
    (new Extend\Settings)
        ->serializeToForum('UrlImage', 'justoverclock-dontgoaway.UrlImage'),
    (new Extend\Settings)
        ->serializeToForum('WidthImg', 'justoverclock-dontgoaway.WidthImg'),
    (new Extend\Settings)
        ->serializeToForum('HeightImg', 'justoverclock-dontgoaway.HeightImg'),
    (new Extend\Settings)
        ->serializeToForum('AltAttr', 'justoverclock-dontgoaway.AltAttr'),
    (new Extend\Settings)
        ->serializeToForum('ModalBtn', 'justoverclock-dontgoaway.ModalBtn'),
    (new Extend\Settings())->serializeToForum('EnableExtLink', 'justoverclock-dontgoaway.enable.extlink', 'boolval', false),
];
