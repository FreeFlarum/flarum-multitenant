<?php

/**
 * This file is part of the-turk/flarum-flamoji.
 *
 * Copyright (c) 2021 Hasan Özbey
 *
 * LICENSE: For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

namespace TheTurk\Flamoji;

use Flarum\Extend;
use s9e\TextFormatter\Configurator;
use TheTurk\Flamoji\Api\Controllers;

return [
    (new Extend\Frontend('forum'))
        ->css(__DIR__.'/less/forum.less')
        ->js(__DIR__.'/js/dist/forum.js'),

    (new Extend\Frontend('admin'))
        ->css(__DIR__.'/less/admin.less')
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Formatter)
        ->configure(ConfigureTextFormatter::class),

    (new Extend\Routes('api'))
        ->get('/the-turk/emojis', 'emojis.list', Controllers\ListEmojisController::class)
        ->post('/the-turk/emojis', 'emojis.create', Controllers\CreateEmojiController::class)
        ->post('/the-turk/import-emojis', 'emojis.import', Controllers\ImportEmojiController::class)
        ->patch('/the-turk/emojis/{id}', 'emojis.update', Controllers\UpdateEmojiController::class)
        ->delete('/the-turk/emojis/{id}', 'emojis.delete', Controllers\DeleteEmojiController::class),

    (new Extend\Settings())
        ->serializeToForum('flamoji.auto_hide', 'the-turk-flamoji.auto_hide', 'boolVal')
        ->serializeToForum('flamoji.show_preview', 'the-turk-flamoji.show_preview', 'boolVal')
        ->serializeToForum('flamoji.show_search', 'the-turk-flamoji.show_search', 'boolVal')
        ->serializeToForum('flamoji.show_variants', 'the-turk-flamoji.show_variants', 'boolVal')
        ->serializeToForum('flamoji.emoji_style', 'the-turk-flamoji.emoji_style')
        ->serializeToForum('flamoji.emoji_data', 'the-turk-flamoji.emoji_data')
        ->serializeToForum('flamoji.emoji_version', 'the-turk-flamoji.emoji_version')
        ->serializeToForum('flamoji.initial_category', 'the-turk-flamoji.initial_category')
        ->serializeToForum('flamoji.show_category_buttons', 'the-turk-flamoji.show_category_buttons', 'boolVal')
        ->serializeToForum('flamoji.show_recents', 'the-turk-flamoji.show_recents', 'boolVal')
        ->serializeToForum('flamoji.recents_count', 'the-turk-flamoji.recents_count', 'intVal')
        ->serializeToForum('flamoji.specify_categories', 'the-turk-flamoji.specify_categories'),
];
