<?php

namespace HCaptcha\Requests;

/**
 * Interface RequestInterface
 *
 * If you want your own request class, it should implement that interface
 *
 * @package hCaptcha
 */
interface RequestInterface
{
    /**
     * Returns raw response from hCaptcha's verify url
     *
     * @param string $verifyUrl
     * @param string $secretKey
     * @param string $response
     * @param null   $userIp
     *
     * @return string
     */
    public function getResponse($verifyUrl, $secretKey, $response, $userIp = null);
}