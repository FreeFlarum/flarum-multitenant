<?php
/**
 * (c) 2019  Matthew Kilgore <matthew@kilgore.dev>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 */

use Flarum\Extend;
use Flarum\Post\Event\Saving;
use Illuminate\Contracts\Events\Dispatcher;
use Tank\Perspective\Listener\ValidatePost;
use Tank\Perspective\Perspective;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),
    new Extend\Locales(__DIR__ . '/resources/locale'),
    function (Dispatcher $events) {
        $events->listen(Saving::class, ValidatePost::class);
    }
];
