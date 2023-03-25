<?php

/*
 * This file is part of ianm/htmlhead.
 *
 * Copyright (c) 2021 IanM.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace IanM\HtmlHead;

use Flarum\Extend;
use Flarum\Frontend\Document;
use IanM\HtmlHead\Api\Controllers;
use Illuminate\Database\Eloquent\Collection;

return [
    
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),

    new Extend\Locales(__DIR__ . '/resources/locale'),

    (new Extend\Frontend('forum'))
        ->content(function (Document $document) {
            /** @var Collection */
            $headCollection = Header::where('active', 1)->get();

            /** @var Header $headItem */
            foreach ($headCollection as $headItem) {
                $document->head[] = $headItem->header;
            }
        }),

    (new Extend\Routes('api'))
        ->get('/html-headers', 'ianm.html-headers.index', Controllers\ListHeadersController::class)
        ->post('/html-headers', 'ianm.html-headers.create', Controllers\CreateHeaderItemController::class)
        ->patch('/html-headers/{id}', 'ianm.html-headers.update', Controllers\UpdateHeaderItemController::class)
        ->delete('/html-headers/{id}', 'ianm.html-headers.delete', Controllers\DeleteHeaderItemController::class),
];
