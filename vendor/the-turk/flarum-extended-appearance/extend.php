<?php

/**
 * Extended Appearanca Extension for Flarum.
 *
 * LICENSE: For the full copyright and license information,
 * please view the LICENSE.md file that was distributed
 * with this source code.
 *
 * @package    the-turk/flarum-extended-appearance
 * @author     Hasan Özbey <hasanoozbey@gmail.com>
 * @copyright  2020
 * @version    Release: 0.1.0
 * @link       https://github.com/the-turk/flarum-extended-appearance
 */

namespace TheTurk\ExtendedAppearance;

use Flarum\Extend;
use Flarum\Foundation\Application;
use Flarum\Frontend\Assets;
use Flarum\Frontend\Compiler\Source\SourceCollector;
use TheTurk\ExtendedAppearance\Extenders\CodeMirrorTheme;

return [
    (new Extend\Frontend('admin'))
        ->css(__DIR__ . '/less/admin.less')
        ->js(__DIR__.'/js/dist/admin.js'),
    (new Extend\Frontend('forum'))
        ->css(__DIR__ . '/less/forum.less'),
    (new Extend\Locales(__DIR__ . '/locale')),
    new Extenders\CodeMirrorTheme(),
    function (Application $app) {
        $settings = $app['flarum.settings'];
        $rightSidebar = $settings->get('exap_theme_right_sidebar') ? 'true' : 'false';

        foreach (['forum', 'admin'] as $frontend) {
            $app->resolving('flarum.assets.' . $frontend, function (Assets $assets) use ($rightSidebar) {
                $assets->css(function (SourceCollector $sources) use ($rightSidebar) {
                    $sources->addString(function () use ($rightSidebar) {
                        return "@config-right-sidebar: {$rightSidebar};";
                    });
                });
            });
        }
    }
];
