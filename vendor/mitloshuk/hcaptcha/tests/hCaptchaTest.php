<?php

use HCaptcha\hCaptcha;
use HCaptcha\Requests\RequestFormatException;
use HCaptcha\Responses\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class hCaptchaTest
 *
 * @package hCaptcha\Tests
 */
class hCaptchaTest extends TestCase
{
    /**
     * Test SECRET KEY from API documentation
     */
    const TEST_SECRET_KEY = '0x0000000000000000000000000000000000000000';

    /**
     * Test RESPONSE from API documentation
     */
    const TEST_RESPONSE = '10000000-aaaa-bbbb-cccc-000000000001';

    /**
     * @return Response
     *
     * @throws RequestFormatException
     */
    public static function simpleRequest()
    {
        $hCaptcha = new hCaptcha(hCaptchaTest::TEST_SECRET_KEY);

        return $hCaptcha->verify(hCaptchaTest::TEST_RESPONSE);
    }

    public function testHCaptchaSuccess()
    {
        $hCaptcha = new hCaptcha(self::TEST_SECRET_KEY);

        $response = $hCaptcha->verify(self::TEST_RESPONSE);

        $this->assertTrue($response->isSuccess());
    }

    public function testHCaptchaWrongResponse()
    {
        $hCaptcha = new hCaptcha(self::TEST_SECRET_KEY);

        $response = $hCaptcha->verify('i-am-wrong-response');

        $this->assertFalse($response->isSuccess());
    }

    public function testHCaptchaFromStaticMethod()
    {
        $isSuccess = hCaptcha::isSuccess(
            self::TEST_RESPONSE,
            self::TEST_SECRET_KEY
        );

        $this->assertTrue($isSuccess);
    }
}
