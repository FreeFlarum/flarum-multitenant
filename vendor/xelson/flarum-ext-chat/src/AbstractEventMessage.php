<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat;

abstract class AbstractEventMessage implements EventMessageInterface
{
	/**
	 * @var string
	 */
	public $id = 'genericEvent';

	/**
	 * @return array
	 */
	abstract public function getAttributes();

	/**
	 * @return string
	 */
	public function content()
	{
		$output = $this->getAttributes();
		$output['id'] = $this->id;

		return json_encode($output);
	}
}