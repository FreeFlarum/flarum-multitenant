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
        $schema->create('discussion_sticky_tag', function (Blueprint $table) {
            $table->integer('discussion_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->primary(['discussion_id', 'tag_id']);
            $table->foreign('discussion_id')->references('id')->on('discussions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
        });
    },

    'down' => function (Builder $schema) {
        $schema->dropIfExists('discussion_sticky_tag');
    },
];
