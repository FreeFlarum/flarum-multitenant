<?php

/*
 * This file is part of askvortsov/flarum-help-tags
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Flarum\Tags\Tests\integration\api\discussions;

use Flarum\Group\Group;
use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;

class CreateTest extends TestCase
{
    use RetrievesAuthorizedUsers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->extension('flarum-tags');
        $this->extension('askvortsov-help-tags');

        $this->prepareDatabase([
            'tags' => [
                ['id' => 1, 'name' => 'Help Tag', 'slug' => '1', 'position' => 0, 'parent_id' => null, 'is_restricted' => true],
            ],
            'users' => [
                $this->normalUser(),
            ],
            'group_permission' => [
                ['group_id' => Group::MEMBER_ID, 'permission' => 'tag1.startDiscussion'],
            ],
        ]);
    }

    /**
     * @test
     */
    public function user_can_create_discussion_in_help_tag()
    {
        $response = $this->send(
            $this->request('POST', '/api/discussions', [
                'authenticatedAs' => 2,
                'json'            => [
                    'data' => [
                        'attributes' => [
                            'title'   => 'test - too-obscure',
                            'content' => 'predetermined content for automated testing - too-obscure',
                        ],
                        'relationships' => [
                            'tags' => [
                                'data' => [
                                    ['type' => 'tags', 'id' => 1],
                                ],
                            ],
                        ],
                    ],
                ],
            ])
        );

        $this->assertEquals(201, $response->getStatusCode());
    }
}
