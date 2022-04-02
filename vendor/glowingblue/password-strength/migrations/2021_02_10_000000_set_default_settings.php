<?php
/*
 * This file is part of glowingblue/password-strength.
 *
 * Copyright (c) 2021 Rafael Horvat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Builder;

return [
	'up' => function (Builder $schema) {
		/**
		 * @var \Flarum\Settings\SettingsRepositoryInterface
		 */
		$settings = resolve('flarum.settings');

		$prefix = 'glowingblue-password-strength';
		$oldPrefix = 'the-turk-password-strength';

		// Take over the old settings (old namespace) or set defaults

		$settings->set("$prefix.weakColor", $settings->get("$oldPrefix.weakColor", '255,129,128'));
		$settings->set("$prefix.mediumColor", $settings->get("$oldPrefix.mediumColor", '249,197,117'));
		$settings->set("$prefix.strongColor", $settings->get("$oldPrefix.strongColor", '111,199,164'));

		$settings->set("$prefix.enableInputColor", $settings->get("$oldPrefix.weakColor", 0));
		$settings->set("$prefix.enableInputBorderColor", $settings->get("$oldPrefix.weakColor", 1));
		$settings->set("$prefix.enablePasswordToggle", $settings->get("$oldPrefix.weakColor", 1));

		// Delete potentially existing old settings
		$settings->delete("$oldPrefix.weakColor");
		$settings->delete("$oldPrefix.mediumColor");
		$settings->delete("$oldPrefix.strongColor");

		$settings->delete("$oldPrefix.enableInputColor");
		$settings->delete("$oldPrefix.enableInputBorderColor");
		$settings->delete("$oldPrefix.enablePasswordToggle");
	},
	'down' => function (Builder $schema) {
		/**
		 * @var \Flarum\Settings\SettingsRepositoryInterface
		 */
		$settings = resolve('flarum.settings');

		$prefix = 'glowingblue-password-strength';

		$settings->delete("$prefix.weakColor");
		$settings->delete("$prefix.mediumColor");
		$settings->delete("$prefix.strongColor");

		$settings->delete("$prefix.enableInputColor");
		$settings->delete("$prefix.enableInputBorderColor");
		$settings->delete("$prefix.enablePasswordToggle");
	},
];
