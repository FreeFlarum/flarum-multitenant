<?php

/*
 * This file is part of Stickiest.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('discussions', function (Blueprint $table) {
            $table->dropIndex(['is_tagSticky', 'last_posted_at']);
            $table->dropIndex(['is_tagSticky', 'created_at']);
        });
    },

    'down' => function (Builder $schema) {
        $schema->table('discussions', function (Blueprint $table) {
            $table->index(['is_tagSticky', 'last_posted_at']);
            $table->index(['is_tagSticky', 'created_at']);
        });
    },
];
