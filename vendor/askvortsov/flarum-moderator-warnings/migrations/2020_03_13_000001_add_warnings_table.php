<?php

/*
 * This file is part of askvortsov/flarum-moderator-warnings
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if ($schema->hasTable('warnings')) {
            return;
        }

        $schema->create('warnings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('user_id')->unsigned();
            $table->integer('strikes');
            $table->mediumText('public_comment');
            $table->mediumText('private_comment');
            $table->timestamps();
            $table->integer('created_user_id')->unsigned()->nullable();
            $table->dateTime('hidden_at')->nullable();
            $table->integer('hidden_user_id')->unsigned()->nullable();

            $table->integer('post_id')->unsigned()->nullable();

            $table->index('user_id', 'user_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('created_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('hidden_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('set null');
        });
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('warnings');
    },
];
