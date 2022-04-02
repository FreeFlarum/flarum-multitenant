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
        $schema->create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total_messages');
            $table->timestamps();
        });
    },


    'down' => function (Builder $schema) {
        $schema->dropIfExists('conversations');
    }
];
