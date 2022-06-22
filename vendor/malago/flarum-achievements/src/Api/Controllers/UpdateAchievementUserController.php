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

use Malago\Achievements\Api\Serializers\AchievementUserSerializer;
use Malago\Achievements\Achievement;
use Malago\Achievements\AchievementUser;
use Malago\Achievements\AchievementValidator;
use Flarum\Api\Controller\AbstractShowController;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class UpdateAchievementUserController extends AbstractShowController
{
    /**
     * {@inheritdoc}
     */
    public $serializer = AchievementUserSerializer::class;

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
        $id = Arr::get($request->getQueryParams(), 'id');
        
        $data = Arr::get($request->getParsedBody(), 'data', []);
        $attributes = Arr::get($data, 'attributes', []);

        if (isset($attributes['new'])) {
            $achuser = AchievementUser::where("id",$id)
                ->where("user_id",Arr::get($attributes,"user_id"))
                ->update(['new' => $attributes['new']]);
            
            return $achuser;
        }
    }
}