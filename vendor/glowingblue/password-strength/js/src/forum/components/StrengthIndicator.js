/*
 * This file is part of glowingblue/password-strength.
 *
 * Copyright (c) 2021 Rafael Horvat.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

import Component from 'flarum/common/Component';

export default class StrengthIndicator extends Component {
	oninit(vnode) {
		super.oninit(vnode);
	}

	view() {
		const { label, color } = this.attrs;
		return (
			<div className={`StrengthIndicator ${label ? 'active' : ''}`}>
				<div className='StrengthIndicator-container'>
					<div className='StrengthIndicator-pills'>
						{['weak', 'medium', 'strong'].map((key) => (
							<StrengthPill color={color} active={this.isPillActive(key)} />
						))}
					</div>
					<div className='StrengthIndicator-label'>
						<span>{label}</span>
					</div>
				</div>
			</div>
		);
	}

	isPillActive(key) {
		const { score } = this.attrs;
		switch (key) {
			case 'weak':
				if (Number.isInteger(score)) {
					return true;
				}
			case 'medium':
				if (score >= 2) {
					return true;
				}
			case 'strong':
				if (score >= 4) {
					return true;
				}

			default:
				return false;
		}
	}
}

class StrengthPill extends Component {
	view() {
		const { color, active } = this.attrs;
		const backgroundColor = active ? color : undefined;
		return <div className='StrengthPill' style={{ backgroundColor }}></div>;
	}
}
