<?php

/*
 * This file is part of afrux/top-posters-widget.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Afrux\OnlineUsers;

use Flarum\Api\Controller\ShowForumController;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\Http\RequestUtil;
use Flarum\User\User;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;

class LoadForumOnlineUsersRelationship
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @var Factory
     */
    private $cache;

    public function __construct(SettingsRepositoryInterface $settings, Factory $cache, UserRepository $repository)
    {
        $this->settings = $settings;
        $this->cache = $cache;
        $this->repository = $repository;
    }

    public function __invoke(ShowForumController $controller, &$data, ServerRequestInterface $request)
    {
        $loadWithInitialResponse = $this->settings->get('afrux-forum-widgets-core.prefer_data_with_initial_load', false);

        if (! $loadWithInitialResponse) {
            return;
        }

        $actor = RequestUtil::getActor($request);

        $data['onlineUsers'] = $this->repository->getOnlineUsers($actor);
    }
}
