<?php

/*
 * This file is part of ianm/synopsis.
 *
 * (c) 2020 - 2022 Ian Morland
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IanM\Synopsis\Tests\integration\api;

use Carbon\Carbon;
use Flarum\Discussion\Discussion;
use Flarum\Testing\integration\TestCase;

class DiscussionTest extends TestCase
{
    protected function setup(): void
    {
        parent::setup();

        $this->extension('flarum-tags', 'ianm-synopsis');

        $this->prepareDatabase([
            'users' => [
                ['id' => 3, 'username' => 'potato', 'email' => 'potato@machine.local', 'is_email_confirmed' => 1],
                ['id' => 4, 'username' => 'toby', 'email' => 'toby@machine.local', 'is_email_confirmed' => 1],
                ['id' => 5, 'username' => 'bad_user', 'email' => 'bad_user@machine.local', 'is_email_confirmed' => 1],
            ],
            'discussions' => [
                ['id' => 2, 'title' => __CLASS__, 'created_at' => Carbon::now(), 'last_posted_at' => Carbon::now(), 'user_id' => 3, 'first_post_id' => 4, 'comment_count' => 2, 'last_post_id' => 21],
            ],
            'posts' => [
                ['id' => 4, 'number' => 2, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 3, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="TobyFlarum___" id="5" number="2" discussionid="2" username="toby">@tobyuuu#5</POSTMENTION></r>'],
                ['id' => 5, 'number' => 3, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 4, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="potato" id="4" number="3" discussionid="2" username="potato">@potato#4</POSTMENTION></r>'],
                ['id' => 6, 'number' => 4, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 3, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="i_am_a_deleted_user" id="7" number="5" discussionid="2" username="i_am_a_deleted_user">@"i_am_a_deleted_user"#p7</POSTMENTION></r>'],
                ['id' => 7, 'number' => 5, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 2021, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="POTATO$" id="2010" number="7" discussionid="2">@"POTATO$"#2010</POSTMENTION></r>'],
                ['id' => 8, 'number' => 6, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 4, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="i_am_a_deleted_user" id="2020" number="8" discussionid="2" username="i_am_a_deleted_user">@"i_am_a_deleted_user"#p2020</POSTMENTION></r>'],
                ['id' => 9, 'number' => 10, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 5, 'type' => 'comment', 'content' => '<r><p>I am bad</p></r>'],
                ['id' => 10, 'number' => 11, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 4, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="Bad &quot;#p6 User" id="9" number="10" discussionid="2">@"Bad "#p6 User"#p9</POSTMENTION></r>'],
                ['id' => 11, 'number' => 12, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 40, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="Bad &quot;#p6 User" id="9" number="10" discussionid="2">@"Bad "#p6 User"#p9</POSTMENTION></r>'],
                ['id' => 12, 'number' => 13, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 4, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="deleted_user" id="11" number="12" discussionid="2">@"acme"#p11</POSTMENTION></r>'],
                ['id' => 13, 'number' => 14, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 3, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="TobyFlarum___" id="5" number="2" discussionid="2" username="toby">@tobyuuu#5</POSTMENTION></r>'],
                ['id' => 14, 'number' => 15, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 4, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="potato" id="4" number="3" discussionid="2" username="potato">@potato#4</POSTMENTION></r>'],
                ['id' => 15, 'number' => 16, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 3, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="i_am_a_deleted_user" id="7" number="5" discussionid="2" username="i_am_a_deleted_user">@"i_am_a_deleted_user"#p7</POSTMENTION></r>'],
                ['id' => 16, 'number' => 17, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 2021, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="POTATO$" id="2010" number="7" discussionid="2">@"POTATO$"#2010</POSTMENTION></r>'],
                ['id' => 17, 'number' => 18, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 4, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="i_am_a_deleted_user" id="2020" number="8" discussionid="2" username="i_am_a_deleted_user">@"i_am_a_deleted_user"#p2020</POSTMENTION></r>'],
                ['id' => 18, 'number' => 19, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 5, 'type' => 'comment', 'content' => '<r><p>I am bad</p></r>'],
                ['id' => 19, 'number' => 20, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 4, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="Bad &quot;#p6 User" id="9" number="10" discussionid="2">@"Bad "#p6 User"#p9</POSTMENTION></r>'],
                ['id' => 20, 'number' => 21, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 40, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="Bad &quot;#p6 User" id="9" number="10" discussionid="2">@"Bad "#p6 User"#p9</POSTMENTION></r>'],
                ['id' => 21, 'number' => 22, 'discussion_id' => 2, 'created_at' => Carbon::now(), 'user_id' => 4, 'type' => 'comment', 'content' => '<r><POSTMENTION displayname="deleted_user" id="11" number="12" discussionid="2">@"acme"#p11</POSTMENTION></r>'],
            ],
        ]);
    }

    /**
     * @test
     */
    public function discussion_has_firstPost_relation()
    {
        $response = $this->send(
            $this->request('GET', '/api/discussions')
        );

        $this->assertEquals(200, $response->getStatusCode());

        $response = json_decode($response->getBody(), true);

        $this->assertIsArray($response['data'][0]['relationships']['firstPost']);
        $this->assertEquals('posts', $response['data'][0]['relationships']['firstPost']['data']['type']);
        $this->assertEquals(4, $response['data'][0]['relationships']['firstPost']['data']['id']);
        $this->assertNotNull(Discussion::find(2)->firstPost);
        $this->assertEquals(4, Discussion::find(2)->firstPost->id);
        $this->assertArrayNotHasKey('lastPost', $response['data'][0]['relationships']);
    }

    /**
     * @test
     */
    public function discussion_has_lastPost_relation()
    {
        $this->settings['ianm-synopsis.excerpt-type'] = 'last';

        $response = $this->send(
            $this->request('GET', '/api/discussions')
        );

        $this->assertEquals(200, $response->getStatusCode());

        $response = json_decode($response->getBody(), true);

        $this->assertIsArray($response['data'][0]['relationships']['lastPost']);
        $this->assertEquals('posts', $response['data'][0]['relationships']['lastPost']['data']['type']);
        $this->assertEquals(21, $response['data'][0]['relationships']['lastPost']['data']['id']);
        $this->assertNotNull(Discussion::find(2)->lastPost);
        $this->assertEquals(21, Discussion::find(2)->lastPost->id);
        $this->assertArrayNotHasKey('firstPost', $response['data'][0]['relationships']);
    }
}
