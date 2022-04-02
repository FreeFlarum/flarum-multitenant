<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('pushedx_messages', function (Blueprint $table) {
            $table->string('message', 1024)->change();
        });
    },
    'down' => function (Builder $schema) {
        $schema->table('pushedx_messages', function (Blueprint $table) {
            $table->string('message')->change();
        });
    }
];
