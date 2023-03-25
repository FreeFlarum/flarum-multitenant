<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        // In the current version, this table only exists to serve as a unique subject to the notification
        // The content is not actually shown anywhere
        // But it could be useful in a future version of just as an audit log
        $schema->create('money_to_all', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->float('amount');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('money_to_all');
    },
];
