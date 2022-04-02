<?php

/**
 * Quiet Edits Extension for Flarum.
 *
 * LICENSE: For the full copyright and license information,
 * please view the LICENSE.md file that was distributed
 * with this source code.
 *
 * @package    the-turk/flarum-quiet-edits
 * @author     Hasan Özbey <hasanoozbey@gmail.com>
 * @copyright  2020
 * @license    The MIT License
 * @version    Release: 0.1.3
 * @link       https://github.com/the-turk/flarum-quiet-edits
 */

namespace TheTurk\QuietEdits;

use Flarum\Extend;
use Illuminate\Contracts\Events\Dispatcher;
use TheTurk\QuietEdits\Listeners\PostActions;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    (new Extend\Locales(__DIR__ . '/locale')),

    (new Extend\Event())
        ->subscribe(Listeners\PostActions::class),
];
