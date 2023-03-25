<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('discussion_user', function (Blueprint $table) use ($schema) {
            if ($schema->hasColumn('discussion_user', 'bookmarked_at')) {
                // Previous package clarkwinkelmann/flarum-ext-bookmarks had the column but no index
                $table->index('bookmarked_at');
            } else {
                $table->timestamp('bookmarked_at')->nullable()->index();
            }
        });
    },
    'down' => function (Builder $schema) {
        if ($schema->hasColumn('discussion_user', 'bookmarked_at')) {
            $schema->dropColumns('discussion_user', 'bookmarked_at');
        }
    },
];
