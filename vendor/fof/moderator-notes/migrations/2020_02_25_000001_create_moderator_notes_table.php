<?php

/*
 * This file is part of fof/moderator-notes.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if ($schema->hasTable('users_notes')) {
            return;
        }

        $schema->create('users_notes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('user_id')->unsigned();
            $table->mediumText('note');
            $table->integer('added_by_user_id')->unsigned();
            $table->timestamps();

            $table->index('user_id', 'user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('added_by_user_id')->references('id')->on('users');
        });
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('users_notes');
    },
];
