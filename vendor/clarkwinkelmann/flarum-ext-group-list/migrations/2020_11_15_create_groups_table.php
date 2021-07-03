<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->create('clarkwinkelmann_group_list', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('group_id')->unique();
            $table->text('content')->nullable();
            $table->unsignedInteger('order')->index()->nullable();

            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('clarkwinkelmann_group_list');
    },
];
