<?php

/*
 * This file is part of justoverclock/header-slideshow.
 *
 * Copyright (c) 2021 Marco Colia.
 * https://flarum.it
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Justoverclock\HeaderSlideShow;

use Flarum\Extend;
use Flarum\Api\Event\Serializing;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),
    new Extend\Locales(__DIR__.'/locale'),
    (new Extend\Settings)
        ->serializeToForum('TitleSlide1', 'justoverclock-header-slideshow.TitleSlide1'),
    (new Extend\Settings)
        ->serializeToForum('TextSlide1', 'justoverclock-header-slideshow.TextSlide1'),
    (new Extend\Settings)
        ->serializeToForum('BtnSlide1', 'justoverclock-header-slideshow.BtnSlide1'),
    (new Extend\Settings)
        ->serializeToForum('LinkOne', 'justoverclock-header-slideshow.LinkOne'),
    (new Extend\Settings)
        ->serializeToForum('ImageOne', 'justoverclock-header-slideshow.ImageOne'),
    (new Extend\Settings)
        ->serializeToForum('TitleSlide2', 'justoverclock-header-slideshow.TitleSlide2'),
    (new Extend\Settings)
        ->serializeToForum('TextSlide2', 'justoverclock-header-slideshow.TextSlide2'),
    (new Extend\Settings)
        ->serializeToForum('BtnSlide2', 'justoverclock-header-slideshow.BtnSlide2'),
    (new Extend\Settings)
        ->serializeToForum('LinkTwo', 'justoverclock-header-slideshow.LinkTwo'),
    (new Extend\Settings)
        ->serializeToForum('ImageTwo', 'justoverclock-header-slideshow.ImageTwo'),
    (new Extend\Settings)
        ->serializeToForum('TitleSlide3', 'justoverclock-header-slideshow.TitleSlide3'),
    (new Extend\Settings)
        ->serializeToForum('TextSlide3', 'justoverclock-header-slideshow.TextSlide3'),
    (new Extend\Settings)
        ->serializeToForum('BtnSlide3', 'justoverclock-header-slideshow.BtnSlide3'),
    (new Extend\Settings)
        ->serializeToForum('LinkThree', 'justoverclock-header-slideshow.LinkThree'),
    (new Extend\Settings)
        ->serializeToForum('ImageThree', 'justoverclock-header-slideshow.ImageThree'),
    (new Extend\Settings)
        ->serializeToForum('TransitionTime', 'justoverclock-header-slideshow.TransitionTime'),
];
