/*
 * This file is part of glowingblue/password-strength.
 *
 * Copyright (c) 2021 Rafael Horvat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

import Component from 'flarum/common/Component';
import icon from 'flarum/common/helpers/icon';

export default class EyeButton extends Component {
	oninit(vnode) {
		super.oninit(vnode);
	}

	view() {
		const { showing } = this.attrs;
		return (
			<span className='EyeButton' onclick={() => showing(!showing())}>
				{icon(`fas fa-eye${showing() ? '-slash' : ''}`)}
			</span>
		);
	}
}
