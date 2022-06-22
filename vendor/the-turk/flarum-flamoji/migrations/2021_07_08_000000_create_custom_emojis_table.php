<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if ($schema->hasTable('custom_emojis')) {
            return;
        }

        $schema->create(
            'custom_emojis',
            function (Blueprint $table) {
                $table->increments('id');

                $table->string('title')->nullable();
                $table->string('text_to_replace')->nullable();
                $table->string('path');
            }
        );
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('custom_emojis');
    },
];
