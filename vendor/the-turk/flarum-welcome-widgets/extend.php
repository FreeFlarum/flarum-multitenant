<?php

/**
 * Welcome Widgets Extension for Flarum.
 *
 * LICENSE: For the full copyright and license information,
 * please view the LICENSE.md file that was distributed
 * with this source code.
 *
 * @package    the-turk/flarum-welcome-widgets
 * @author     Hasan Özbey <hasanoozbey@gmail.com>
 * @copyright  2020
 * @version    Release: 0.1.0
 * @link       https://github.com/the-turk/flarum-welcome-widgets
 */

namespace TheTurk\WelcomeWidgets;

use Flarum\Extend;
use Flarum\User\User;
use Illuminate\Contracts\Events\Dispatcher;

return [
    (new Extend\Frontend('forum'))
        ->css(__DIR__ . '/less/forum.less')
        ->js(__DIR__.'/js/dist/forum.js'),
    (new Extend\Locales(__DIR__ . '/locale')),

    (new Extend\Model(User::class))
        ->hasOne('welcome_widgets', Models\WelcomeWidgets::class, 'user_id'),

    function (Dispatcher $events) {
        $events->subscribe(Listeners\SetAttributes::class);
    }
];
