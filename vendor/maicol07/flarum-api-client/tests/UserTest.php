<?php


namespace Maicol07\Flarum\Api\Tests;

use Maicol07\Flarum\Api\Resource\Collection;
use Maicol07\Flarum\Api\Resource\Resource;

class UserTest extends TestCase
{
    /**
     * @test
     *
     * @return Collection
     */
    public function getUsers(): Collection
    {
        $users = $this->client->users()->request();

        self::assertInstanceOf(Collection::class, $users);

        return $users;
    }

    /**
     * @test
     *
     * @return Resource
     */
    public function getUser(): Resource
    {
        // Get by ID
        $user = $this->client->users((int)env('FLARUM_USERID'))->request();
        self::assertInstanceOf(Resource::class, $user);

        // Get by username
        $user = $this->client->users(env('FLARUM_USERNAME'))->request();
        self::assertInstanceOf(Resource::class, $user);

        return $user;
    }
}
