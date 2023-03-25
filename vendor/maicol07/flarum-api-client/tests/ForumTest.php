<?php


namespace Maicol07\Flarum\Api\Tests;

use Maicol07\Flarum\Api\Resource\Item;

class ForumTest extends TestCase
{
    /**
     * @test
     *
     * @return Item
     */
    public function forumTest(): Item
    {
        $info = $this->client->request();
        
        self::assertInstanceOf(Item::class, $info);
        
        return $info;
    }
}
