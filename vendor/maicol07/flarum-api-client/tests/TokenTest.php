<?php


namespace Maicol07\Flarum\Api\Tests;

use Maicol07\Flarum\Api\Resource\Token;

class TokenTest extends TestCase
{
    /**
     * @test
     *
     * @return Token
     */
    public function tokenTest(): Token
    {
        $request = $this->client->token()->post([
            'identification' => env('FLARUM_USERNAME'),
            'password' => env('FLARUM_PASSWORD')
        ]);
        $token = $request->request();
        
        self::assertInstanceOf(Token::class, $token);
        self::assertIsInt($token->userId);
        self::assertIsString($token->token);
        
        return $token;
    }
}
