<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('achievements', function($table) {
            $table->boolean('hidden')->default(false);
        });
    },
    'down' => function (Builder $schema) {
    },
];