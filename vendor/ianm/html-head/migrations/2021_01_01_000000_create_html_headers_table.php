<?php

/*
 * This file is part of ianm/html-head.
 *
 * Copyright (c) 2021 IanM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if ($schema->hasTable('html_headers')) {
            return;
        }

        $schema->create('html_headers', function (Blueprint $table) use ($schema) {
            $table->increments('id');

            $table->text('description', 200);
            $table->text('header', 300);
            $table->boolean('active');
            $table->timestamps();
        });
    },
    'down' => function (Builder $schema) {
        $schema->dropIfExists('html_headers');
    },
];