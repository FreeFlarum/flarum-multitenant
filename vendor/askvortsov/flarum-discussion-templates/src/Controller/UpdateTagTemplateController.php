<?php

/*
 * This file is part of askvortsov/flarum-discussion-templates
 *
 *  Copyright (c) 2020 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Askvortsov\FlarumDiscussionTemplates\Controller;

use Flarum\Api\Controller\AbstractShowController;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\Tags\Api\Serializer\TagSerializer;
use Flarum\Tags\Tag;
use Flarum\User\AssertPermissionTrait;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class UpdateTagTemplateController extends AbstractShowController
{
    use AssertPermissionTrait;

    /**
     * {@inheritdoc}
     */
    public $serializer = TagSerializer::class;

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
     * {@inheritdoc}
     */
    public function data(ServerRequestInterface $request, Document $document)
    {
        $this->assertAdmin($request->getAttribute('actor'));
        $id = array_get($request->getQueryParams(), 'id');
        $data = array_get($request->getParsedBody(), 'data', []);

        $tag = Tag::findOrFail($id);

        $tag->template = isset($data['template']) ? $data['template'] : '';

        $tag->save();

        return $tag;
    }
}
