/*
 * This file is part of glowingblue/password-strength.
 *
 * Copyright (c) 2021 Rafael Horvat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

import app from 'flarum/common/app';
import icon from 'flarum/common/helpers/icon';
import { slug } from '../common';

// Make translation calls shorter
const t = app.translator.trans.bind(app.translator);
const prfx = `${slug}.admin.settings`;

app.initializers.add(slug, () => {
	app.extensionData
		.for(slug)
		.registerSetting(() => (
			<div className='Form-group'>
				<label className='psHeading'>{t(`${prfx}.colorOptions`)}</label>
				<div className='helpText psHelpText'>
					{icon('fas fa-exclamation-circle')}
					<span>{t(`${prfx}.colorHelp`)}</span>
				</div>
			</div>
		))
		.registerSetting({
			setting: `${slug}.weakColor`,
			type: 'text',
			label: t(`${prfx}.weakColor`),
		})
		.registerSetting({
			setting: `${slug}.mediumColor`,
			type: 'text',
			label: t(`${prfx}.mediumColor`),
		})
		.registerSetting({
			setting: `${slug}.strongColor`,
			type: 'text',
			label: t(`${prfx}.strongColor`),
		})
		.registerSetting(() => (
			<div className='Form-group'>
				<label className='psHeading'>{t(`${prfx}.otherOptions`)}</label>
			</div>
		))
		.registerSetting({
			setting: `${slug}.enableInputColor`,
			type: 'boolean',
			label: t(`${prfx}.enableInputColor`),
		})
		.registerSetting({
			setting: `${slug}.enableInputBorderColor`,
			type: 'boolean',
			label: t(`${prfx}.enableInputBorderColor`),
		})
		.registerSetting({
			setting: `${slug}.enablePasswordToggle`,
			type: 'boolean',
			label: t(`${prfx}.enablePasswordToggle`),
		});
});
