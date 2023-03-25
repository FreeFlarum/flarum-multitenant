<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->create('achievements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',200);
            $table->text('description');
            $table->string('computation',100);
            $table->integer('points');
            $table->string('image',255);
            $table->string('rectangle',100);
            $table->boolean('active')->default(true);
        });

        $schema->create('achievement_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('achievement_id')->unsigned();
            $table->timestamps();
            $table->boolean('new')->default(false);
            
            $table->index(['user_id', 'achievement_id']);
            
            $table->foreign('achievement_id')->references('id')->on('achievements')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('achievement_user');
        $schema->dropIfExists('achievements');
    },
];