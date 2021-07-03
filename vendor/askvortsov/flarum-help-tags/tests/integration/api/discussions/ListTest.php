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
                ['id' => 1, 'name' => 'Help Tag', 'slug' => '1', 'position' => 0, 'parent_id' => null, 'is_restricted' => true],
            ],
            'users' => [
                $this->normalUser(),
            ],
            'discussions' => [
                ['id' => 1, 'title' => 'admin discussion', 'user_id' => 1, 'comment_count' => 1],
                ['id' => 2, 'title' => 'user discussion', 'user_id' => 2, 'comment_count' => 1],
                ['id' => 3, 'title' => 'user discussion', 'user_id' => 1, 'comment_count' => 1, 'show_to_all' => true],
            ],
            'posts' => [
                ['id' => 1, 'discussion_id' => 1, 'user_id' => 1, 'type' => 'comment', 'content' => '<t><p></p></t>'],
                ['id' => 2, 'discussion_id' => 2, 'user_id' => 2, 'type' => 'comment', 'content' => '<t><p></p></t>'],
                ['id' => 1, 'discussion_id' => 3, 'user_id' => 1, 'type' => 'comment', 'content' => '<t><p></p></t>'],
            ],
            'discussion_tag' => [
                ['discussion_id' => 1, 'tag_id' => 1],
                ['discussion_id' => 2, 'tag_id' => 1],
                ['discussion_id' => 3, 'tag_id' => 1],
            ],
        ]);
    }

    /**
     * @test
     */
    public function admin_sees_all_discussions_in_help_tag()
    {
        $response = $this->send(
            $this->request('GET', '/api/discussions', [
                'authenticatedAs' => 1,
            ])
        );

        $data = json_decode($response->getBody()->getContents(), true)['data'];
        $ids = Arr::pluck($data, 'id');

        $this->assertEqualsCanonicalizing(['1', '2', '3'], $ids);
    }

    /**
     * @test
     */
    public function user_sees_own_discussion_and_discussion_shown_to_all()
    {
        $this->prepareDatabase(['group_permission' => [
            ['group_id' => Group::MEMBER_ID, 'permission' => 'tag1.startDiscussion'],
        ],
        ]);

        $response = $this->send(
            $this->request('GET', '/api/discussions', [
                'authenticatedAs' => 2,
            ])
        );

        $data = json_decode($response->getBody()->getContents(), true)['data'];
        $ids = Arr::pluck($data, 'id');

        $this->assertEqualsCanonicalizing(['2', '3'], $ids);
    }

    /**
     * //  * @test
     * //  */
    // public function user_sees_own_discussion_and_discussion_shown_to_all_if_start_discussion_perms_revoked()
    // {
    //     $this->prepareDatabase([
    //         'group_permission' => [
    //             ['group_id' => Group::MEMBER_ID, 'permission' => 'tag1.viewTag'],
    //         ],
    //     ]);

    //     $response = $this->send(
    //         $this->request('GET', '/api/discussions', [
    //             'authenticatedAs' => 2,
    //         ])
    //     );

    //     $data = json_decode($response->getBody()->getContents(), true)['data'];
    //     $ids = Arr::pluck($data, 'id');

    //     $this->assertEqualsCanonicalizing(['2', '3'], $ids);
    // }

    /**
     * @test
     */
    public function guest_doesnt_see_anything_by_default()
    {
        $response = $this->send(
            $this->request('GET', '/api/discussions')
        );

        $data = json_decode($response->getBody()->getContents(), true)['data'];
        $ids = Arr::pluck($data, 'id');

        $this->assertEqualsCanonicalizing([], $ids);
    }

    // /**
    //  * @test
    //  */
    // public function guest_sees_visible_to_all_if_can_see_tag()
    // {
    //     $this->prepareDatabase(['group_permission' => [
    //             ['group_id' => Group::GUEST_ID, 'permission' => 'tag1.viewTag'],
    //         ]
    //     ]);

    //     $response = $this->send(
    //         $this->request('GET', '/api/discussions')
    //     );

    //     $data = json_decode($response->getBody()->getContents(), true)['data'];
    //     $ids = Arr::pluck($data, 'id');

    //     $this->assertEqualsCanonicalizing(['3'], $ids);
    // }
}
