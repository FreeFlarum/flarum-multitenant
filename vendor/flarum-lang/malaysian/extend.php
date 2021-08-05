<?php

/*
 * This file is part of the flarum-malaysian.
 *
 */

return [
	new Flarum\Extend\LanguagePack(),
	(new Flarum\Extend\Frontend('forum'))->css(__DIR__ . '/less/main.less'),
];
