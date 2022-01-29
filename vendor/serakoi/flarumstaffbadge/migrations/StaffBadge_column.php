<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if (!$schema->hasColumn('users', 'staffBadge')) {
            $schema->table('users', function (Blueprint $table) use ($schema) {
                $table->string('staffBadge', 150)->after('username')->index()->nullable();
            });
        }  
        if (!$schema->hasColumn('users', 'tagList')) {
            $schema->table('users', function (Blueprint $table) use ($schema) {
                $table->string('tagList', 150)->after('username')->index()->nullable();
            });
        }   
    },

    'down' => function (Builder $schema) {
        $schema->table('users', function (Blueprint $table) use ($schema) {
            $table->dropColumn('staffBadge');
            $table->dropColumn('tagList');
        });
    },
];