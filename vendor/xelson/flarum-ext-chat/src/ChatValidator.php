<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat;

use Flarum\Foundation\AbstractValidator;

class ChatValidator extends AbstractValidator
{
	protected function getRules()
	{		
		return 
		[
			'title' => 
			[
				"max:100"
			],
			'color' =>
			[
				"max:20"
			],
			'icon' =>
			[
				"max:100"
			],
			'type' => 
			[
				'required',
				"min:0|max:1"
			]
		];
	}
}