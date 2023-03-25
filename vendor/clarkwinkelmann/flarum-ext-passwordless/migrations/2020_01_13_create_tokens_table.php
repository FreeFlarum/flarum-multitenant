<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->create('clarkwinkelmann_passwordless_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('token')->index();
            $table->boolean('remember')->default(false);
            $table->timestamp('created_at')->index();
            $table->timestamp('expires_at')->index();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('clarkwinkelmann_passwordless_tokens');
    },
];
