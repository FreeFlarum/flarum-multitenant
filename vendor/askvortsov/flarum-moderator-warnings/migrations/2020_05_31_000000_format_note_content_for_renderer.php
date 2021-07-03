<?php

/*
 * This file is part of askvortsov/flarum-moderator-warnings
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

use Askvortsov\FlarumWarnings\Model\Warning;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $formatter = Warning::getFormatter();

        Warning::chunkById(1000, function ($warnings) use ($formatter) {
            foreach ($warnings as $warning) {
                $warning->public_comment = $formatter->parse($warning->public_comment);
                $warning->private_comment = $formatter->parse($warning->private_comment);
                $warning->save();
            }
        });
    },

    'down' => function (Builder $schema) {
        // changes should be kept
    },
];
