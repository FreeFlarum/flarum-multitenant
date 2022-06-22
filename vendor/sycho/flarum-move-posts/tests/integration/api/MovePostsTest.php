<?php

namespace SychO\MovePosts\tests\integration\api;

use Flarum\Discussion\Discussion;
use Flarum\Post\CommentPost;
use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\ConnectionResolverInterface;

class MovePostsTest extends TestCase
{
    use RetrievesAuthorizedUsers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->extension('sycho-move-posts');

        $this->prepareDatabase([
            'users' => [
                ['id' => 1, 'username' => 'Muralf', 'email' => 'muralf@machine.local', 'is_email_confirmed' => 1],
                ['id' => 2, 'username' => 'Potato', 'email' => 'potato@machine.local', 'is_email_confirmed' => 1],
            ],
            'discussions' => [
                ['id' => 1, 'title' => __CLASS__, 'created_at' => '2021-08-04 23:01:25', 'last_posted_at' => '2021-08-04 23:01:25', 'user_id' => 1, 'first_post_id' => 1, 'last_post_id' => 15, 'last_post_number' => 7,'comment_count' => 7],
                ['id' => 2, 'title' => __CLASS__, 'created_at' => '2021-08-01 13:00:00', 'last_posted_at' => '2021-08-05 15:30:00', 'user_id' => 2, 'first_post_id' => 6, 'last_post_id' => 13, 'last_post_number' => 8,'comment_count' => 10],
                ['id' => 3, 'title' => __CLASS__, 'created_at' => '2021-08-01 13:00:00', 'last_posted_at' => '2021-08-05 22:30:00', 'user_id' => 2, 'first_post_id' => 16, 'last_post_id' => 21, 'last_post_number' => 6,'comment_count' => 10],
            ],
            'posts' => [
                ['id' => 1, 'created_at' => '2021-08-01 12:00:00', 'number' => 1, 'content' => '<t>potato</t>', 'user_id' => 1, 'discussion_id' => 1, 'type' => 'comment'],
                ['id' => 2, 'created_at' => '2021-08-01 18:43:00', 'number' => 2, 'content' => '<t>potato</t>', 'user_id' => 1, 'discussion_id' => 1, 'type' => 'comment'],
                ['id' => 3, 'created_at' => '2021-08-02 08:26:00', 'number' => 3, 'content' => '<t>potato</t>', 'user_id' => 1, 'discussion_id' => 1, 'type' => 'comment'],
                ['id' => 4, 'created_at' => '2021-08-03 15:23:52', 'number' => 4, 'content' => '<t>potato</t>', 'user_id' => 1, 'discussion_id' => 1, 'type' => 'comment'],
                ['id' => 5, 'created_at' => '2021-08-04 23:01:25', 'number' => 5, 'content' => '<t>potato</t>', 'user_id' => 1, 'discussion_id' => 1, 'type' => 'comment'],
                ['id' => 14, 'created_at' => '2021-08-04 23:02:25', 'number' => 6, 'content' => '<t>potato</t>', 'user_id' => 1, 'discussion_id' => 1, 'type' => 'comment'],
                ['id' => 15, 'created_at' => '2021-08-04 23:03:25', 'number' => 7, 'content' => '<t>potato</t>', 'user_id' => 1, 'discussion_id' => 1, 'type' => 'comment'],

                ['id' => 6, 'created_at' => '2021-08-05 00:00:00', 'number' => 1, 'content' => '<t>potato</t>', 'user_id' => 2, 'discussion_id' => 2, 'type' => 'comment'],
                ['id' => 7, 'created_at' => '2021-08-05 01:00:00', 'number' => 2, 'content' => '<t>potato</t>', 'user_id' => 2, 'discussion_id' => 2, 'type' => 'comment'],
                ['id' => 8, 'created_at' => '2021-08-05 02:00:00', 'number' => 3, 'content' => '<t>potato</t>', 'user_id' => 2, 'discussion_id' => 2, 'type' => 'comment'],
                ['id' => 9, 'created_at' => '2021-08-05 03:30:00', 'number' => 4, 'content' => '<t>potato</t>', 'user_id' => 2, 'discussion_id' => 2, 'type' => 'comment'],
                ['id' => 10, 'created_at' => '2021-08-05 05:30:00', 'number' => 5, 'content' => '<t>potato</t>', 'user_id' => 1, 'discussion_id' => 2, 'type' => 'comment'],
                ['id' => 11, 'created_at' => '2021-08-05 08:30:00', 'number' => 6, 'content' => '<t>potato</t>', 'user_id' => 1, 'discussion_id' => 2, 'type' => 'comment'],
                ['id' => 12, 'created_at' => '2021-08-05 10:30:00', 'number' => 7, 'content' => '<t>potato</t>', 'user_id' => 1, 'discussion_id' => 2, 'type' => 'comment'],
                ['id' => 13, 'created_at' => '2021-08-05 15:30:00', 'number' => 8, 'content' => '<t>potato</t>', 'user_id' => 1, 'discussion_id' => 2, 'type' => 'comment'],

                ['id' => 16, 'created_at' => '2021-08-01 13:00:00', 'number' => 1, 'content' => '<t>potato</t>', 'user_id' => 2, 'discussion_id' => 3, 'type' => 'comment'],
                ['id' => 17, 'created_at' => '2021-08-02 06:00:00', 'number' => 2, 'content' => '<t>potato</t>', 'user_id' => 2, 'discussion_id' => 3, 'type' => 'comment'],
                ['id' => 18, 'created_at' => '2021-08-03 18:00:00', 'number' => 3, 'content' => '<t>potato</t>', 'user_id' => 2, 'discussion_id' => 3, 'type' => 'comment'],
                ['id' => 19, 'created_at' => '2021-08-04 23:30:00', 'number' => 4, 'content' => '<t>potato</t>', 'user_id' => 2, 'discussion_id' => 3, 'type' => 'comment'],
                ['id' => 20, 'created_at' => '2021-08-05 20:30:00', 'number' => 5, 'content' => '<t>potato</t>', 'user_id' => 1, 'discussion_id' => 3, 'type' => 'comment'],
                ['id' => 21, 'created_at' => '2021-08-05 22:30:00', 'number' => 6, 'content' => '<t>potato</t>', 'user_id' => 1, 'discussion_id' => 3, 'type' => 'comment'],
            ],
        ]);
    }

    /** @test */
    public function simple_move_to_existing_discussion_pushes_posts_at_the_end()
    {
        $postIds = [10, 11, 12, 13];
        $targetDiscussionId = 1;
        $sourceDiscussionId = 2;

        $response = $this->send(
            $this->request('POST', '/api/posts/move', [
                'authenticatedAs' => 1,
                'json' => [
                    'data' => [
                        'postIds' => $postIds,
                        'sourceDiscussionId' => $sourceDiscussionId,
                        'targetDiscussionId' => $targetDiscussionId,
                    ],
                ],
            ])
        );

        $posts = CommentPost::query()->find($postIds);
        /** @var Discussion $targetDiscussion */
        $targetDiscussion = Discussion::query()->find($targetDiscussionId);
        /** @var Discussion $sourceDiscussion */
        $sourceDiscussion = Discussion::query()->find($sourceDiscussionId);

        $targetDiscussionMaxNumber = $targetDiscussion->posts()->max('number');
        $sourceDiscussionMaxNumber = $sourceDiscussion->posts()->max('number');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([8, 9, 10, 11], $posts->pluck('number')->toArray());
        $this->assertEquals(11, $targetDiscussionMaxNumber);
        $this->assertEquals(8, $sourceDiscussionMaxNumber);
        $this->assertEquals(11, $targetDiscussion->last_post_number);
        $this->assertEquals(4, $sourceDiscussion->last_post_number);
    }

    /** @test */
    public function simple_move_to_new_discussion_pushes_posts_at_the_end()
    {
        $postIds = [10, 11, 12, 13];
        $sourceDiscussionId = 2;

        $response = $this->send(
            $this->request('POST', '/api/posts/move', [
                'authenticatedAs' => 1,
                'json' => [
                    'data' => [
                        'newDiscussion' => true,
                        'newDiscussionTitle' => 'Potato will take over the world',
                        'postIds' => $postIds,
                        'sourceDiscussionId' => 2,
                    ],
                ],
            ])
        );

        $posts = CommentPost::query()->find($postIds);

        /** @var Discussion $targetDiscussion */
        $targetDiscussion = $posts->first()->discussion;;
        /** @var Discussion $sourceDiscussion */
        $sourceDiscussion = Discussion::query()->find($sourceDiscussionId);

        $targetDiscussionMaxNumber = $targetDiscussion->posts()->max('number');
        $sourceDiscussionMaxNumber = $sourceDiscussion->posts()->max('number');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([1, 2, 3, 4], $posts->pluck('number')->toArray());
        $this->assertEquals(4, $targetDiscussionMaxNumber);
        $this->assertEquals(8, $sourceDiscussionMaxNumber);
        $this->assertEquals(4, $targetDiscussion->last_post_number);
        $this->assertEquals(4, $sourceDiscussion->last_post_number);
        $this->assertEquals(4, $targetDiscussion->comment_count);
    }

    /** @test */
    public function complex_move_to_existing_discussion_pushes_posts_in_between()
    {
        $postIds = [17, 18, 19, 20, 21];
        $targetDiscussionId = 1;
        $sourceDiscussionId = 3;

        $response = $this->send(
            $this->request('POST', '/api/posts/move', [
                'authenticatedAs' => 1,
                'json' => [
                    'data' => [
                        'postIds' => $postIds,
                        'sourceDiscussionId' => $sourceDiscussionId,
                        'targetDiscussionId' => $targetDiscussionId,
                    ],
                ],
            ])
        );

        $posts = CommentPost::query()->find($postIds);

        /** @var Discussion $targetDiscussion */
        $targetDiscussion = Discussion::query()->find($targetDiscussionId);
        /** @var Discussion $sourceDiscussion */
        $sourceDiscussion = Discussion::query()->find($sourceDiscussionId);

        $targetDiscussionMaxNumber = $targetDiscussion->posts()->max('number');
        $sourceDiscussionMaxNumber = $sourceDiscussion->posts()->max('number');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([3, 6, 10, 11, 12], $posts->pluck('number')->toArray());
        $this->assertEquals([1, 2, 17, 3, 4, 18, 5, 14, 15, 19, 20, 21], $targetDiscussion->posts->pluck('id')->toArray());
        $this->assertEquals(12, $targetDiscussionMaxNumber);
        $this->assertEquals(6, $sourceDiscussionMaxNumber);
        $this->assertEquals(12, $targetDiscussion->last_post_number);
        $this->assertEquals(1, $sourceDiscussion->last_post_number);
    }

    /** @test */
    public function cannot_move_posts_from_different_discussions()
    {
        $postIds = [7, 8, 9, 20, 21];
        $targetDiscussionId = 1;
        $sourceDiscussionId = 3;

        $response = $this->send(
            $this->request('POST', '/api/posts/move', [
                'authenticatedAs' => 1,
                'json' => [
                    'data' => [
                        'postIds' => $postIds,
                        'sourceDiscussionId' => $sourceDiscussionId,
                        'targetDiscussionId' => $targetDiscussionId,
                    ],
                ],
            ])
        );

        $this->assertEquals(409, $response->getStatusCode());
        $this->assertEquals('move_posts_from_different_discussions', json_decode($response->getBody()->getContents(), true)['errors'][0]['code']);
    }

    /** @test */
    public function cannot_move_older_posts_to_newer_discussions()
    {
        $postIds = [2, 3, 4, 5];
        $targetDiscussionId = 2;
        $sourceDiscussionId = 1;

        $response = $this->send(
            $this->request('POST', '/api/posts/move', [
                'authenticatedAs' => 1,
                'json' => [
                    'data' => [
                        'postIds' => $postIds,
                        'sourceDiscussionId' => $sourceDiscussionId,
                        'targetDiscussionId' => $targetDiscussionId,
                    ],
                ],
            ])
        );

        $this->assertEquals(409, $response->getStatusCode());
        $this->assertEquals('move_old_post_to_newer_discussion', json_decode($response->getBody()->getContents(), true)['errors'][0]['code']);
    }

    /*
     * The tests below create the discussions and posts first through the API before moving.
     */

    /** @test */
    public function simple_move_to_existing_discussion_pushes_posts_at_the_end__with_api_created_posts()
    {
        // Create source discussion
        $sourceDiscussionResponse = $this->send(
            $this->request('POST', '/api/discussions', [
                'authenticatedAs' => 1,
                'json' => [
                    'data' => [
                        'attributes' => [
                            'title' => "API Created Source Discussion",
                            'content' => "ACME1",
                        ],
                    ],
                ],
            ])
        );

        // Create Target Discussion
        $targetDiscussionResponse = $this->send(
            $this->request('POST', '/api/discussions', [
                'authenticatedAs' => 2,
                'json' => [
                    'data' => [
                        'attributes' => [
                            'title' => "API Created Target Discussion",
                            'content' => "ACME2",
                        ],
                    ],
                ],
            ])
        );

        $sourceDiscussionData = json_decode($sourceDiscussionResponse->getBody()->getContents(), true);
        $targetDiscussionData = json_decode($targetDiscussionResponse->getBody()->getContents(), true);

        $postIds = [];

        $sourceDiscussionId = $sourceDiscussionData['data']['id'];
        $targetDiscussionId = $targetDiscussionData['data']['id'];

        // Create posts in source discussion
        for ($i = 0; $i < 4; $i++) {
            $postResponse = $this->send(
                $this->request('POST', '/api/posts', [
                    'authenticatedAs' => 1,
                    'json' => [
                        'data' => [
                            'attributes' => [
                                'content' => "Auto Source Discussion Reply $i",
                            ],
                            'relationships' => [
                                'discussion' => ['data' => ['id' => $sourceDiscussionId]],
                            ],
                        ],
                    ],
                ])
            );

            $postIds[] = json_decode($postResponse->getBody()->getContents(), true)['data']['id'];
        }

        $response = $this->send(
            $this->request('POST', '/api/posts/move', [
                'authenticatedAs' => 1,
                'json' => [
                    'data' => [
                        'postIds' => $postIds,
                        'sourceDiscussionId' => $sourceDiscussionId,
                        'targetDiscussionId' => $targetDiscussionId,
                    ],
                ],
            ])
        );

        $posts = CommentPost::query()->find($postIds);

        /** @var Discussion $targetDiscussion */
        $targetDiscussion = Discussion::query()->find($targetDiscussionId);
        /** @var Discussion $sourceDiscussion */
        $sourceDiscussion = Discussion::query()->find($sourceDiscussionId);

        $targetDiscussionMaxNumber = $targetDiscussion->posts()->max('number');
        $sourceDiscussionMaxNumber = $sourceDiscussion->posts()->max('number');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([2, 3, 4, 5], $posts->pluck('number')->toArray());
        $this->assertEquals(5, $targetDiscussionMaxNumber);
        // max number remains the same because of the new event posts
        $this->assertEquals(5, $sourceDiscussionMaxNumber);
        $this->assertEquals(5, $targetDiscussion->last_post_number);
        $this->assertEquals(1, $sourceDiscussion->last_post_number);
    }
}
