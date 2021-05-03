<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Api\Throttler;

use DateTime;
use Flarum\User\User;
use Flarum\Settings\SettingsRepositoryInterface;

use Xelson\Chat\Message;

class ChatMessage
{
	/**
	 * @var SettingsRepositoryInterface
	 */
	protected $settings;

	/**
	 * @param SettingsRepositoryInterface $settings
	 */
	public function __construct(SettingsRepositoryInterface $settings)
	{
		$this->settings = $settings;
	}

	/**
	 * @param User $actor
	 * @return bool
	 */
	public function __invoke($request): bool
	{
		$actor = $request->getAttribute('actor');


		if (!in_array($request->getAttribute('routeName'), ['discussions.create', 'posts.create'])) {
			return false;
		}

		$number = $this->settings->get('xelson-chat.settings.floodgate.number');
		$time = $this->settings->get('xelson-chat.settings.floodgate.time');

		if ($number <= 0) return false;

		$lastMessages = Message::where('created_at', '>=', new DateTime('-' . $time))
			->where('user_id', $actor->id)
			->orderBy('id', 'DESC')
			->limit($number)
			->get();

		if (count($lastMessages) <= $number) {
			return false;
		}

		return true;
	}
}
