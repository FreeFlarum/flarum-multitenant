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
        $schema->table('users_notes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['added_by_user_id']);
        });

        $schema->table('users_notes', function (Blueprint $table) {
            $table->integer('added_by_user_id')->unsigned()->nullable()->change();
        });

        $schema->table('users_notes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('added_by_user_id')->references('id')->on('users')->onDelete('set null');
        });
    },

    'down' => function (Builder $schema) {
        // changes should be kept
    },
];
