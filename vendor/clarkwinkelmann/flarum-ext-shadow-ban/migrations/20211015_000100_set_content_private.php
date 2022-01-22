<?php

use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->getConnection()->table('discussions')->whereNotNull('shadow_hidden_at')->update([
            'is_private' => true,
        ]);

        $schema->getConnection()->table('posts')->whereNotNull('shadow_hidden_at')->update([
            'is_private' => true,
        ]);
    },
    'down' => function (Builder $schema) {
        // Since migrations can't be rolled back by step, there's no sense rolling this back
    },
];
