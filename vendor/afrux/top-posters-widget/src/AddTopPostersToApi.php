<?php

/*
 * This file is part of afrux/top-posters-widget.
 *
 * Copyright (c) 2021 Sami Mazouz.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Afrux\TopPosters;

use function Afrux\ForumWidgets\Helper\pretty_number_format;

class AddTopPostersToApi
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $data = $this->repository->getTopPosters();

        foreach ($data as $id => $count) {
            $data[$id] = pretty_number_format($count);
        }

        return [
            'afrux-top-posters-widget.topPosterCounts' => $data,
        ];
    }
}
