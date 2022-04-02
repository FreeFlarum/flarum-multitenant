<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->create('catchthefish_rankings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('round_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('catch_count')->index();
            $table->timestamps();

            $table->foreign('round_id')->references('id')->on('catchthefish_rounds')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('catchthefish_rankings');
    },
];
