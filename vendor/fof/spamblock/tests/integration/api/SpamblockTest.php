<?php

/*
 * This file is part of fof/spamblock.
 *
 * Copyright (c) FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FoF\Spamblock\Tests\integration\api;

use Carbon\Carbon;
use Flarum\Group\Group;
use Flarum\Post\CommentPost;
use Flarum\Testing\integration\TestCase;

class SpamblockTest extends TestCase
{
    protected function setup(): void
    {
        parent::setup();

        $this->extension('fof-spamblock');

        $this->prepareDatabase([
            'users' => [
                ['id' => 3, 'username' => 'a_moderator', 'email' => 'a_mod@machine.local', 'is_email_confirmed' => 1],
                ['id' => 4, 'username' => 'toby', 'email' => 'toby@machine.local', 'is_email_confirmed' => 1],
                ['id' => 5, 'username' => 'bad_user', 'email' => 'bad_user@machine.local', 'is_email_confirmed' => 1],
            ],
            'group_user' => [
                ['user_id' => 3, 'group_id' => Group::MODERATOR_ID],
            ],
            'group_permission' => [
                ['group_id' => Group::MODERATOR_ID, 'permission' => 'user.spamblock'],
            ],
            'discussions' => [
                ['id' => 2, 'title' => __CLASS__, 'created_at' => Carbon::now(), 'last_posted_at' => Carbon::now(), 'user_id' => 5, 'first_post_id' => 4, 'comment_count' => 2, 'last_post_id' => 5],
            ],
            'posts' => [
                ['id' => 4, 'number' => 2, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 5, 'type' => 'comment', 'content' => '<r>Some spammy content</r>'],
                ['id' => 5, 'number' => 3, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 4, 'type' => 'comment', 'content' => '<r>Some regular content</r>'],
            ],
        ]);
    }

    /**
     * @test
     */
    public function moderator_cannot_spamblock_self()
    {
        $response = $this->send(
            $this->request('POST', 'api/users/3/spamblock', [
                'authenticatedAs' => 3,
            ])
        );

        $this->assertEquals(403, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function user_without_permissions_cannot_spamblock()
    {
        $response = $this->send(
            $this->request('POST', 'api/users/3/spamblock', [
                'authenticatedAs' => 4,
            ])
        );

        $this->assertEquals(403, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function moderator_can_spamblock_and_posts_are_hidden()
    {
        $response = $this->send(
            $this->request('POST', 'api/users/5/spamblock', [
                'authenticatedAs' => 3,
            ])
        );

        $this->assertEquals(204, $response->getStatusCode());

        $response = $this->send(
            $this->request('GET', 'api/discussions/2', [
                'authenticatedAs' => 3,
            ])
        );

        $this->assertEquals(200, $response->getStatusCode());

        $response = json_decode($response->getBody(), true);

        $this->assertTrue($response['data']['attributes']['isHidden']);
        $this->assertNotNull($response['data']['attributes']['hiddenAt']);
        $this->assertNotNull(CommentPost::find(4)->hidden_at);
        $this->assertNull(CommentPost::find(5)->hidden_at);
    }

    /**
     * @test
     */
    public function normal_user_cannot_see_spamblocked_posts()
    {
        $response = $this->send(
            $this->request('POST', 'api/users/5/spamblock', [
                'authenticatedAs' => 3,
            ])
        );

        $this->assertEquals(204, $response->getStatusCode());

        $response = $this->send(
            $this->request('GET', 'api/discussions/2', [
                'authenticatedAs' => 4,
            ])
        );

        $this->assertEquals(404, $response->getStatusCode());
    }
}
