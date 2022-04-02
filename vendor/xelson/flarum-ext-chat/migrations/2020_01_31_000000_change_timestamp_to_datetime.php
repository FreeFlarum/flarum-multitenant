<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $connection = $schema->getConnection();
        $prefix = $connection->getTablePrefix();
        
        $connection->statement("ALTER TABLE `{$prefix}pushedx_messages` MODIFY created_at DATETIME");
        $connection->statement("ALTER TABLE `{$prefix}pushedx_messages` MODIFY edited_at DATETIME");
    },
    'down' => function (Builder $schema) {
        $connection = $schema->getConnection();
        $prefix = $connection->getTablePrefix();

        $connection->statement("ALTER TABLE `{$prefix}pushedx_messages` MODIFY created_at TIMESTAMP");
        $connection->statement("ALTER TABLE `{$prefix}pushedx_messages` MODIFY edited_at TIMESTAMP");
    }
];
