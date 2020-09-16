<?php namespace PerspectiveApi\Test;

use PerspectiveApi\CommentsClient;
use PerspectiveApi\CommentsException;
use PerspectiveApi\CommentsResponse;
use PHPUnit\Framework\TestCase;

class CommentsClientSuggestScoreTest extends TestCase {
    /** @var CommentsResponse */
    protected static $response;

    public static function setUpBeforeClass(): void {
        $commentsClient = new CommentsClient(getenv('PERSPECTIVE_API_TOKEN'));
        $commentsClient->comment(['text' => 'What kind of idiot name is foo? Sorry, I like your name.']);
        $commentsClient->languages(['en']);
        $commentsClient->context(['entries' => ['text' => 'off-topic', 'type' => 'PLAIN_TEXT']]);
        $commentsClient->clientToken('some-token');
        $commentsClient->communityId('unit-test');
        $commentsClient->attributeScores(['TOXICITY' => [
            'summaryScore' => ['value' => 0.83785176, 'type' => 'PROBABILITY'],
            'spanScores' => [['begin' => 0, 'end' => 32, 'score' => ['value' => 0.9208521, 'type' => 'PROBABILITY']]]]
        ]);

        self::$response = $commentsClient->suggestScore();
    }

    public function testLanguages() {
        $detectedLanguages = self::$response->detectedLanguages();

        $this->assertIsArray($detectedLanguages);
        $this->assertContains('en', $detectedLanguages);
    }

    public function testClientToken() {
        $clientToken = self::$response->clientToken();

        $this->assertEquals('some-token', $clientToken);
    }

    public function testCommentsException() {
        $this->expectException(CommentsException::class);
        $this->expectExceptionMessage('The request is missing a valid API key.');

        $commentsClient = new CommentsClient('');
        $commentsClient->suggestScore();
    }
}
