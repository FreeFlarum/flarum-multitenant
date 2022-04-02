<?php
/*
 * This file is part of xelson/flarum-ext-chat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xelson\Chat\Commands;

use Flarum\User\User;

class PostMessage
{

    /**
     * @var User
     */
    public $actor;

    /**
     * @var array
     */
    public $data;

    /**
     * @var string
     */
    public $ip_address;

    /**
     * @param User $actor
     * @param mixed $data
     * @param string $ip_address
     */
    public function __construct(User $actor, $data, string $ip_address)
    {
        $this->actor = $actor;
        $this->data = $data;
        $this->ip_address = $ip_address;
    }
}
