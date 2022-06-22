<?php

use Flarum\Database\Migration;

return Migration::addSettings(
    [
        'the-turk-flamoji.auto_hide' => true,
        'the-turk-flamoji.show_preview' => false,
        'the-turk-flamoji.show_search' => true,
        'the-turk-flamoji.show_variants' => true,
        'the-turk-flamoji.emoji_style' => 'twemoji',
        'the-turk-flamoji.emoji_data' => 'en',
        'the-turk-flamoji.emoji_version' => '12.1',
        'the-turk-flamoji.initial_category' => 'smileys',
        'the-turk-flamoji.show_category_buttons' => true,
        'the-turk-flamoji.show_recents' => true,
        'the-turk-flamoji.recents_count' => 50,
        'the-turk-flamoji.specify_categories' => "[\"smileys\",\"people\",\"animals\",\"food\",\"activities\",\"travel\",\"objects\",\"symbols\",\"flags\"]",
    ]
);
