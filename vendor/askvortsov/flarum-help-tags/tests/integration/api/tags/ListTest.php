<?php

/*
 * This file is part of askvortsov/flarum-help-tags
 *
 *  Copyright (c) 2021 Alexander Skvortsov.
 *
 *  For detailed copyright and license information, please view the
 *  LICENSE file that was distributed with this source code.
 */

namespace Flarum\Tags\Tests\integration\api\tags;

use Flarum\Group\Group;
use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;
use Illuminate\Support\Arr;

class ListTest extends TestCase
{
    use RetrievesAuthorizedUsers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->extension('flarum-tags');
        $this->extension('askvortsov-help-tags');

        $this->prepareDatabase([
            'tags' => [
                ['id' => 1, 'name' => 'No Restrictions', 'slug' => '1', 'position' => 0, 'parent_id' => null],
                ['id' => 2, 'name' => 'Can view but not start', 'slug' => '2', 'position' => 0, 'parent_id' => null, 'is_restricted' => true],
                ['id' => 3, 'name' => 'Can start but not view', 'slug' => '3', 'position' => 0, 'parent_id' => null, 'is_restricted' => true],
                ['id' => 4, 'name' => 'Cant view or start', 'slug' => '4', 'position' => 0, 'parent_id' => null, 'is_restricted' => true],
                ['id' => 5, 'name' => 'Cant view or start, but has viewTag', 'slug' => '5', 'position' => 0, 'parent_id' => null, 'is_restricted' => true],
            ],
            'users' => [
                $this->normalUser(),
            ],
            'group_permission' => [
                ['group_id' => Group::MEMBER_ID, 'permission' => 'tag2.viewForum'],
                ['group_id' => Group::MEMBER_ID, 'permission' => 'tag3.startDiscussion'],
                ['group_id' => Group::MEMBER_ID, 'permission' => 'tag5.viewTag'],
            ],
        ]);
    }

    /**
     * @test
     */
    public function admin_sees_proper_tags()
    {
        $response = $this->send(
            $this->request('GET', '/api/tags', [
                'authenticatedAs' => 1,
            ])
        );

        $data = json_decode($response->getBody()->getContents(), true)['data'];
        $ids = Arr::pluck($data, 'id');

        $this->assertEqualsCanonicalizing(['1', '2', '3', '4', '5'], $ids);
    }

    /**
     * @test
     */
    public function user_sees_proper_tags()
    {
        $response = $this->send(
            $this->request('GET', '/api/tags', [
                'authenticatedAs' => 2,
            ])
        );

        $data = json_decode($response->getBody()->getContents(), true)['data'];
        $ids = Arr::pluck($data, 'id');

        $this->assertEqualsCanonicalizing(['1', '2', '3', '5'], $ids);
    }

    /**
     * @test
     */
    public function guest_only_sees_open_tag_by_default()
    {
        $response = $this->send(
            $this->request('GET', '/api/tags')
        );

        $data = json_decode($response->getBody()->getContents(), true)['data'];
        $ids = Arr::pluck($data, 'id');

        $this->assertEqualsCanonicalizing(['1'], $ids);
    }

    /**
     * @test
     */
    public function guest_sees_open_tag_and_tags_where_can_viewTag_if_granted()
    {
        $this->prepareDatabase([
            'group_permission' => [
                ['group_id' => Group::GUEST_ID, 'permission' => 'tag5.viewTag'],
            ],
        ]);

        $response = $this->send(
            $this->request('GET', '/api/tags')
        );

        $data = json_decode($response->getBody()->getContents(), true)['data'];
        $ids = Arr::pluck($data, 'id');

        $this->assertEqualsCanonicalizing(['1', '5'], $ids);
    }
}
