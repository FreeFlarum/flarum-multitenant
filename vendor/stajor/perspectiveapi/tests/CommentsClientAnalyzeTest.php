<?php namespace PerspectiveApi\Test;

use PerspectiveApi\CommentsClient;
use PerspectiveApi\CommentsException;
use PerspectiveApi\CommentsResponse;
use PHPUnit\Framework\TestCase;

class CommentsClientAnalyzeTest extends TestCase {
    /** @var CommentsResponse */
    protected static $response;

    public static function setUpBeforeClass(): void {
        $commentsClient = new CommentsClient($_ENV['PERSPECTIVE_API_TOKEN']);
        $commentsClient->comment(['text' => 'What kind of idiot name is foo? Sorry, I like your name.']);
        $commentsClient->languages(['en']);
        $commentsClient->context(['entries' => ['text' => 'off-topic', 'type' => 'PLAIN_TEXT']]);
        $commentsClient->requestedAttributes(['TOXICITY' => ['scoreType' => 'PROBABILITY', 'scoreThreshold' => 0]]);
        $commentsClient->spanAnnotations(true);
        $commentsClient->doNotStore(true);
        $commentsClient->clientToken('some-token');
        $commentsClient->sessionId('ses1');

        self::$response = $commentsClient->analyze();
    }

    public function testHasCommentsResponseInstance() {
        $this->assertInstanceOf(CommentsResponse::class, self::$response);
    }

    public function testAttributeScores(): void {
        $attributeScores = self::$response->attributeScores();

        $this->assertIsArray($attributeScores);
        $this->arrayHasKey('TOXICITY');
        $this->assertGreaterThan(0.8, $attributeScores['TOXICITY']['summaryScore']['value']);
    }

    public function testLanguages() {
        $languages = self::$response->languages();

        $this->assertIsArray($languages);
        $this->assertContains('en', $languages);
    }

    public function testClientToken() {
        $clientToken = self::$response->clientToken();

        $this->assertEquals('some-token', $clientToken);
    }

    public function testCommentsException() {
        $this->expectException(CommentsException::class);
        $this->expectExceptionMessage('The request is missing a valid API key.');

        $commentsClient = new CommentsClient('');
        $commentsClient->analyze();
    }
}
