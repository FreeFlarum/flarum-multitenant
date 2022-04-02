<?php

/*
 * This file is part of the flarum-sinhala.
 *
 */

return [
	new Flarum\Extend\LanguagePack(),
	(new Flarum\Extend\Frontend('forum'))->css(__DIR__ . '/less/main.less'),
];
