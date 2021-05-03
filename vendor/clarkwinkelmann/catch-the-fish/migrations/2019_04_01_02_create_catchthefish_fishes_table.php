<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->create('catchthefish_fishes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('round_id');
            $table->unsignedInteger('discussion_id_placement')->nullable();
            $table->unsignedInteger('post_id_placement')->nullable();
            $table->unsignedInteger('user_id_placement')->nullable();
            $table->unsignedInteger('user_id_last_catch')->nullable(); // To determine which user is allowed to edit fish
            $table->unsignedInteger('user_id_last_placement')->nullable(); // To show last user who placed fish
            $table->unsignedInteger('user_id_last_naming')->nullable(); // To show last user who renamed fish
            $table->timestamp('placement_valid_since')->nullable()->index(); // To automatically apply previously random placement when custom placement expires
            $table->timestamp('last_caught_at')->nullable()->index();
            $table->string('name');
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('round_id')->references('id')->on('catchthefish_rounds')->onDelete('cascade');
            $table->foreign('discussion_id_placement')->references('id')->on('discussions')->onDelete('set null');
            $table->foreign('post_id_placement')->references('id')->on('posts')->onDelete('set null');
            $table->foreign('user_id_placement')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_id_last_catch')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_id_last_placement')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_id_last_naming')->references('id')->on('users')->onDelete('set null');
        });
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('catchthefish_fishes');
    },
];
