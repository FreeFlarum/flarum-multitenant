<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('users', function($table) {
            $table->text('new_achievements');
        });
    },
    'down' => function (Builder $schema) {
        $schema->table('users', function($table) {
            $table->dropColumn('new_achievements');
        });
    },
];