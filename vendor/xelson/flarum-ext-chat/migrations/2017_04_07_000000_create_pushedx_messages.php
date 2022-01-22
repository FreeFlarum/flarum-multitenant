<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if(!$schema->hasTable('pushedx_messages'))
        {
            $schema->create('pushedx_messages', function (Blueprint $table) {
                $table->increments('id');

                $table->string('message');

                $table->integer('actorId')->unsigned()->nullable();

                $table->timestamp('created_at');
            });
        }
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('pushedx_messages');
    }
];
