/*
 * This file is part of glowingblue/password-strength.
 *
 * Copyright (c) 2021 Rafael Horvat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

import app from 'flarum/common/app';
import { extend } from 'flarum/common/extend';
import LogInModal from 'flarum/forum/components/LogInModal';
import SignUpModal from 'flarum/forum/components/SignUpModal';
import Stream from 'flarum/common/utils/Stream';
import { slug } from '../common';
import LogInPasswordField from './components/LogInPasswordField';
import SignUpPasswordField from './components/SignUpPasswordField';

app.initializers.add(slug, () => {
	function extendOninit() {
		this.showingPassword = new Stream(false);
	}
	extend(LogInModal.prototype, 'oninit', extendOninit);
	extend(SignUpModal.prototype, 'oninit', extendOninit);

	extend(LogInModal.prototype, 'fields', function (items) {
		if (app.forum.attribute(`${slug}.enablePasswordToggle`)) {
			items.replace(
				'password',
				<LogInPasswordField
					parent_this={this}
					showingPassword={this.showingPassword.bind(this)}
				/>,
				20,
			);
		}
	});

	extend(SignUpModal.prototype, 'fields', function (items) {
		if (!this.attrs.token) {
			const hasConfirmFiled =
				items.has('nearataConfirmPassword') && this.confirmPassword !== undefined;

			items.replace(
				'password',
				<SignUpPasswordField
					parent_this={this}
					showingPassword={this.showingPassword.bind(this)}
					hasConfirmFiled={hasConfirmFiled}
				/>,
				10,
			);

			if (hasConfirmFiled) {
				items.replace(
					'nearataConfirmPassword',
					<SignUpPasswordField
						parent_this={this}
						showingPassword={this.showingPassword.bind(this)}
						hasConfirmFiled={hasConfirmFiled}
						isConfirmFiled={true}
					/>,
					10,
				);
			}
		}
	});
});
