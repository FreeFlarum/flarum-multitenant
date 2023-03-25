<?php

/*
 * This file is part of justoverclock/flarum-ext-contactme.
 *
 * Copyright (c) 2021 Marco Colia.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Justoverclock\Contactme;

use Flarum\Extend;
use Justoverclock\Contactme\Api\Controller\ContactController;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less')
        ->route('/contact-us', 'justoverclock/flarum-ext-contactme'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/resources/less/admin.less'),
    (new Extend\Routes('forum'))
        ->post('/sendmail', 'justoverclock.sendmail', ContactController::class),
    new Extend\Locales(__DIR__.'/resources/locale'),

];
