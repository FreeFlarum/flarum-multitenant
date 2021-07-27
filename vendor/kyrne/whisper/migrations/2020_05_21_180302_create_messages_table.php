<?php
/**
 *
 *  This file is part of kyrne/whisper
 *
 *  Copyright (c) 2020 Kyrne.
 *
 *  For the full copyright and license information, please view the license.md
 *  file that was distributed with this source code.
 *
 */

Use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if ($schema->hasTable('messages')) {
            return;
        }

        $schema->create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message');
            $table->boolean('is_seen')->default(0);
            $table->boolean('is_hidden')->default(0);
            $table->integer('user_id');
            $table->integer('number')->unsigned();
            $table->integer('conversation_id');
            $table->timestamps();
        });
    },

    'down' => function (Builder $schema) {
        $schema->dropIfExists('messages');
    }
];
