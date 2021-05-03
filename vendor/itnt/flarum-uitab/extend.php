<?php

/**
 * UI Tab Extension for Flarum.
 *
 * LICENSE: For the full copyright and license information,
 * please view the LICENSE.md file that was distributed
 * with this source code.
 *
 * @package    itnt/flarum-uitab
 * @author     Golden <littlegoldenjin@gmail.com>
 * @copyright  2020
 * @license    MIT
 * @link       https://github.com/littlegolden/flarum-uitab
 */

namespace ITNT\UITab;

use Flarum\Extend;
use Illuminate\Contracts\Events\Dispatcher;
use ITNT\UITab\Listeners\LoadSettingsFromDatabase;

return [
	(new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

	(new Extend\Frontend('forum'))
		->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__ . '/resources/less/forum.less'),

	new Extend\Locales(__DIR__ . '/resources/locale'),

	function (Dispatcher $events) {
        $events->subscribe(Listeners\LoadSettingsFromDatabase::class);
    },
	(new Extend\Settings())
        ->serializeToForum('home_page', 'itnt-uitab.home_page')
];
