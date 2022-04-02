<?php

use Illuminate\Database\Schema\Builder;
use Illuminate\Database\Schema\Blueprint;

return [
    'up' => function (Builder $schema) {
        $schema->table('neonchat_chat_user', function (Blueprint $table) {
            $table->tinyInteger('role')->default(0);
            $table->integer('removed_by')->unsigned()->nullable();
            $table->dateTime('readed_at')->nullable();
            $table->dateTime('removed_at')->nullable();
            $table->dateTime('joined_at')->nullable();

            $table->foreign('removed_by')->references('id')->on('users')->onDelete('cascade');
        });
    },

    'down' => function (Builder $schema) {
        $schema->table('neonchat_chat_user', function (Blueprint $table) {
            $table->dropForeign(['removed_by']);

            $table->dropColumn('role', 'removed_by', 'readed_at', 'removed_at', 'joined_at');
        });
    }
];
