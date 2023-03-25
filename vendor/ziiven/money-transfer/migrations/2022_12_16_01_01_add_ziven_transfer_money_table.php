<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if (!$schema->hasTable('ziven_transfer_money')) {
            $schema->create('ziven_transfer_money', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('from_user_id')->unsigned();
                $table->integer('target_user_id')->unsigned();
                $table->float('transfer_money_value')->unsigned();
                $table->dateTime('assigned_at');

                $table->index('assigned_at');
                $table->foreign('from_user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('target_user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    },
    'down' => function (Builder $schema) {
        $schema->drop('ziven_transfer_money');
    },
];
