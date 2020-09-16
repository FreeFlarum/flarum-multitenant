<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    /**
     * Run the migrations.
     */
    'up' => function (Builder $schema) {
        if ($schema->hasTable('welcome_widgets')) return;

        $schema->create('welcome_widgets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique();
            $table->dateTime('last_login_at')->nullable();
            $table->dateTime('previous_login_at')->nullable();
            $table->string('previous_stats')->nullable();
            $table->string('last_stats')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    },

    /**
     * Reverse the migrations.
     */
    'down' => function (Builder $schema) {
        $schema->dropIfExists('welcome_widgets');
    },
];
