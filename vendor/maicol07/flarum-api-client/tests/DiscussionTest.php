<?php

namespace Maicol07\Flarum\Api\Tests;

use Maicol07\Flarum\Api\Client;
use Maicol07\Flarum\Api\Models\Discussion;
use Maicol07\Flarum\Api\Models\Model;
use Maicol07\Flarum\Api\Resource\Collection;
use Maicol07\Flarum\Api\Resource\Item;

class DiscussionTest extends TestCase
{
    /**
     * @test
     * @param array $filters
     * @return Collection
     */
    public function frontpage(array $filters = []): Collection
    {
        $collection = $this->client->discussions()->filter($filters)->request();

        self::assertInstanceOf(Collection::class, $collection);
        self::assertGreaterThan(0, $collection->collect()->count());

        return $collection;
    }

    /**
     * @test
     */
    public function filter(): void
    {
        $this->frontpage([
            'tag' => env('DISCUSSION_TAG_FILTER', 'general')
        ]);
    }

    /**
     * @test
     * @depends frontpage
     * @param Collection $collection
     */
    public function discussion(Collection $collection): Item
    {
        $discussion = $collection->collect()->first();
        self::assertInstanceOf(Item::class, $discussion);

        $item = $this->client->discussions()->id($discussion->id)->request();
        self::assertInstanceOf(Item::class, $item);

        self::assertEquals($discussion->id, $item->id, 'Requesting an existing discussion retrieves an incorrect result.');
        self::assertEquals($discussion->type, $item->type, 'Requesting an existing discussion retrieves an incorrect resource type.');

        $cached = Client::getCache()->get($discussion->id, null, $discussion->type);

        self::assertNotNull($cached, 'Discussion was not automatically persisted to global store.');
        self::assertEquals($discussion->id, $cached->id, 'The wrong discussion was stored into cache.');

        self::assertNotNull($discussion->title);
        self::assertNotNull($discussion->slug);

        self::assertNotNull($discussion->tags, 'The relation tags should be set on a discussion.');

        self::assertNotNull($discussion->firstPost, 'A discussion has a start post.');

        return $discussion;
    }

    /**
     * @test
     */
    public function createsDiscussions()
    {
        if (!$this->client->isAuthorized()) {
            self::markTestSkipped('No authentication set.');
        }

        $discussion = new Discussion([
            'title' => 'Foo',
            'content' => 'Some testing content'
        ]);

        $resource = $discussion->save();

        self::assertInstanceOf(Item::class, $resource);

        self::assertEquals($discussion->title, $resource->title);
        self::assertNotEmpty($resource->firstPost);
        self::assertEquals($discussion->content, $resource->firstPost->content);

        return $resource;
    }

    /**
     * @test
     * @depends createsDiscussions
     * @param Item $resource
     */
    public function deletesDiscussions(Item $resource): void
    {
        if (!$this->client->isAuthorized()) {
            self::markTestSkipped('No authentication set.');
        }

        $discussion = Discussion::fromResource($resource);
        $model = Model::fromResource($resource);

        // Resolve the same instance.
        self::assertEquals($discussion, $model);

        // See if we can delete things.
        self::assertTrue($discussion->delete());
    }
}
