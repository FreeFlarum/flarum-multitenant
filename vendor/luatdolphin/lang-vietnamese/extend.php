<?php
/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
use Flarum\Extend;
use s9e\TextFormatter\Configurator;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/resources/less/forum.less'),
    (new Extend\Formatter)
	    ->configure(function (Configurator $config) {
	        $config->PipeTables;
    }),
	(new Flarum\Extend\LanguagePack()),
]; 