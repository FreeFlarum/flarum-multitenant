<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('pushedx_messages', function (Blueprint $table) {
			$table->timestamp('edited_at')->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
        });
    },
    'down' => function (Builder $schema) {
        $schema->table('pushedx_messages', function (Blueprint $table) {
			$table->dropColumn('edited_at');
			$table->dropColumn('deleted_by');
        });
    }
];
