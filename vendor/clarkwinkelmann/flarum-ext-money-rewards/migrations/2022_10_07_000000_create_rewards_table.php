<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->create('money_rewards', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id')->nullable();
            $table->unsignedInteger('giver_user_id')->nullable();
            $table->unsignedInteger('receiver_user_id')->nullable();
            $table->float('amount');
            $table->boolean('new_money')->default(false);
            $table->text('comment');
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('set null');
            $table->foreign('giver_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('receiver_user_id')->references('id')->on('users')->onDelete('set null');
        });
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('money_rewards');
    },
];
