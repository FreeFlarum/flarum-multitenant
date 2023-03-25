<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if (!$schema->hasColumn('ziven_transfer_money', 'notes')) {
            $schema->table('ziven_transfer_money', function (Blueprint $table) {
                $table->string('notes', 255)->nullable();
            });
        }
    },
    'down' => function (Builder $schema) {
        
    }
];
