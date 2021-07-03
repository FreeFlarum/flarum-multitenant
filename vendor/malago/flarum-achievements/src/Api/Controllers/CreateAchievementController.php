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

use Malago\Achievements\Api\Serializers\AchievementSerializer;
use Malago\Achievements\Achievement;
use Malago\Achievements\AchievementValidator;
use Flarum\Api\Controller\AbstractCreateController;
use Flarum\Group\Group;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class CreateAchievementController extends AbstractCreateController
{
    /**
     * {@inheritdoc}
     */
    public $serializer = AchievementSerializer::class;

    /**
     * {@inheritdoc}
     */
    public $include = ['group'];

    /**
     * @var AchievementValidator
     */
    protected $validator;

    /**
     * @param AchievementValidator $validator
     *
     * @return void
     */
    public function __construct(AchievementValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     */
    protected function data(ServerRequestInterface $request, Document $document)
    {
        $request->getAttribute('actor')->assertCan('administrate');

        $data = Arr::get($request->getParsedBody(), 'data', []);

        $ach = Achievement::build(
            Arr::get($data, 'attributes.name'),
            Arr::get($data, 'attributes.description'),
            Arr::get($data, 'attributes.computation'),
            Arr::get($data, 'attributes.points'),
            Arr::get($data, 'attributes.image'),
            Arr::get($data, 'attributes.rectangle'),
            Arr::get($data, 'attributes.active'),
            Arr::get($data, 'attributes.hidden')
        );

        $this->validator->assertValid($ach->getAttributes());

        $ach->save();

        return $ach;
    }
}