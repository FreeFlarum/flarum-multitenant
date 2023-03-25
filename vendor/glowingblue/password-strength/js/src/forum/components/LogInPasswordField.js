/*
 * This file is part of glowingblue/password-strength.
 *
 * Copyright (c) 2021 Rafael Horvat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

import Component from 'flarum/common/Component';
import extractText from 'flarum/common/utils/extractText';
import EyeButton from './EyeButton';

// Make translation calls shorter
const t = app.translator.trans.bind(app.translator);

export default class LogInPasswordField extends Component {
	oninit(vnode) {
		super.oninit(vnode);
	}

	view() {
		const { parent_this, showingPassword } = this.attrs;

		return (
			// This markup is copied from `flarum/components/LogInModal` and then
			// some things have been added.
			// !!! Please check for updates regularly !!!

			<div className='Form-group PasswordField'>
				<input
					className='FormControl togglable'
					name='password'
					type={showingPassword() ? 'text' : 'password'}
					placeholder={extractText(t('core.forum.log_in.password_placeholder'))}
					bidi={parent_this.password}
					disabled={parent_this.loading}
				/>
				<EyeButton showing={showingPassword} />
			</div>
		);
	}
}
