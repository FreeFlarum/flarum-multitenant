<?php

/*
 * This file is part of the ianm/synopsis.
 *
 * (c) 2020 Ian Morland
 * (c) 2019 Jordan Schnaidt
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IanM\Synopsis;

use Flarum\Api\Controller\ListDiscussionsController;
use Flarum\Api\Controller\UpdateDiscussionController;
use Flarum\Extend;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum/extension.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\Settings())
        ->serializeToForum('synopsis.excerpt_length', 'ianm-synopsis.excerpt_length', function ($value) {
            return (int) $value;
        })
        ->serializeToForum('synopsis.rich_excerpts', 'ianm-synopsis.rich-excerpts', function ($value) {
            return (bool) $value;
        })
        ->serializeToForum('synopsis.excerpt_type', 'ianm-synopsis.excerpt-type'),

    (new Extend\ApiController(ListDiscussionsController::class))
        ->addInclude(['firstPost', 'lastPost']),

    (new Extend\ApiController(UpdateDiscussionController::class))
        ->addInclude(['lastPost']),

    (new Extend\User())
        ->registerPreference('showSynopsisExcerpts', function ($value) {
            return (bool) $value;
        }, true)
        ->registerPreference('showSynopsisExcerptsOnMobile', function ($value) {
            return (bool) $value;
        }, false),
];
