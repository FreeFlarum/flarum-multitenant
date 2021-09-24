<?php

use PHPUnit\Framework\TestCase;
use HCaptcha\Requests\RequestFormatException;

/**
 * Class ResponseTest
 *
 * @package hCaptcha\Tests
 */
class ResponseTest extends TestCase
{
    /**
     * Testing of raw method
     *
     * @throws RequestFormatException
     */
    public function testGettingRawFromResponse()
    {
        $response = hCaptchaTest::simpleRequest();

        $this->assertContains('success', $response->getRaw());
    }

    /**
     * Testing of array method
     *
     * @throws RequestFormatException
     */
    public function testGettingArrayFromResponse()
    {
        $response = hCaptchaTest::simpleRequest();

        $this->assertInternalType('array', $response->getArray());
    }
}
