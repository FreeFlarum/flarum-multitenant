<?php

use Flarum\Extend;
use Illuminate\Contracts\Events\Dispatcher;
use Ziymed\LangArabic\Util\Str;
use Ziymed\LangArabic\Listener;
use Flarum\Discussion\Event\Saving;
use Flarum\Foundation\Event\Validating;

return [
	new Extend\LanguagePack,
	(new Extend\Frontend('forum'))
		->js(__DIR__.'/js/dist/forum.js')
		->content(Listener\ChangeDirection::class),
	(new Extend\Frontend('admin'))
		->js(__DIR__.'/js/dist/admin.js')
		->content(Listener\ChangeDirection::class),

	function (Dispatcher $events) {

		// save the discussion slug in arabic
		$events->listen(Saving::class, function(Saving $event){
			$event->discussion->slug = Str::slug($event->discussion->title);
		});

		// register users in arabic
		$events->listen(Validating::class, function(Validating $event){
			$rules = $event->validator->getRules();
			if (isset($rules['username'])) {
				foreach ($rules['username'] as $k => $v) {
					if (strpos($v, 'regex:') === 0) {
						$rules['username'][$k] = 'alpha_dash';
					}
				}
			}
			$event->validator->setRules($rules);
		});
	},
];









