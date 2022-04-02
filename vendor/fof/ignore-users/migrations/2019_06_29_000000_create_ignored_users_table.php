<?php

/*
 * This file is part of fof/ignore-users.
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
        if ($schema->hasTable('ignored_user')) {
            return;
        }

        $schema->create(
            'ignored_user',
            function (Blueprint $table) {
                $table->integer('user_id')->unsigned();
                $table->integer('ignored_user_id')->unsigned();
                $table->timestamp('ignored_at')->nullable();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
                $table->foreign('ignored_user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

                $table->primary(['user_id', 'ignored_user_id']);
            }
        );
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('ignored_user');
    },
];
