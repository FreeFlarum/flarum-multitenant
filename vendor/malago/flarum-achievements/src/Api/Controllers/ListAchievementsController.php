<?php

/*
 * This file is part of malago/achievements
 *
 *  Copyright (c) 2021 Miguel A. Lago
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Malago\Achievements\Api\Controllers;

use Flarum\Api\Controller\AbstractListController;
use Malago\Achievements\Api\Serializers\AchievementSerializer;
use Malago\Achievements\Achievement;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ListAchievementsController extends AbstractListController
{
    /**
     * @var AchievementSerializer
     */
    public $serializer = AchievementSerializer::class;

    /**
     * @param ServerRequestInterface $request
     * @param Document               $document
     *
     * @return mixed
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = $request->getAttribute('actor');
        $include = $this->extractInclude($request);

        //$actor->assertCan('administrate');

        $ach = Achievement::query()->whereVisibleTo($actor)->get();

        return $ach->load($include);
    }
}