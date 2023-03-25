<?php

use HCaptcha\Requests\CurlRequest;
use HCaptcha\hCaptcha;
use HCaptcha\Responses\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class RequestTest
 *
 * @package hCaptcha\Tests
 */
class RequestTest extends TestCase
{
    public function testEmptyRequest()
    {
        $request = new CurlRequest();

        $response = $request->getResponse(
            hCaptcha::VERIFY_URL,
            hCaptchaTest::TEST_SECRET_KEY,
            ''
        );

        $responseObject = new Response($response);

        $this->assertFalse($responseObject->isSuccess());
    }

    public function testWrongResponseRequest()
    {
        $request = new CurlRequest();

        $response = $request->getResponse(
            hCaptcha::VERIFY_URL,
            hCaptchaTest::TEST_SECRET_KEY,
            'captcha-response-example'
        );

        $responseObject = new Response($response);

        $this->assertFalse($responseObject->isSuccess());
    }

    public function testResponseRequest()
    {
        $request = new CurlRequest();

        $response = $request->getResponse(
            hCaptcha::VERIFY_URL,
            hCaptchaTest::TEST_SECRET_KEY,
            hCaptchaTest::TEST_RESPONSE
        );

        $responseObject = new Response($response);

        $this->assertTrue($responseObject->isSuccess());
    }

    /**
     * Test for response
     *
     * @return void
     */
    public function testWrongRequestUrl()
    {
        $request = new CurlRequest(1);

        $urls = [
            'google.com',
            '',
            'nothing',
            null,
            123,
        ];

        foreach ($urls as $url) {
            $response = $request->getResponse(
                $url,
                hCaptchaTest::TEST_SECRET_KEY,
                ''
            );

            $responseObject = new Response($response);

            $this->assertContains('status code', $response);

            $this->assertFalse($responseObject->isSuccess());

            foreach ($responseObject->getErrors() as $error) {
                $this->assertContains('status code', $error);
            }
        }
    }
}
