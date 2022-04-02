<?php

namespace HCaptcha\Requests;

/**
 * Curl is default request method
 *
 * @package hCaptcha
 */
class CurlRequest implements RequestInterface
{
    /**
     * Request to hCaptcha timeout
     *
     * @var int $timeout
     */
    protected $timeout;

    public function __construct($timeout = 5)
    {
        $this->timeout = $timeout;
    }

    /**
     * @inheritDoc
     */
    public function getResponse($verifyUrl, $secretKey, $response, $userIp = null)
    {
        $requestParams = [
            'response' => $response,
            'secret'   => $secretKey,
            'remoteip' => $userIp,
        ];

        $ch = curl_init($verifyUrl);

        $options = [
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($requestParams),
            CURLOPT_HEADER         => false,
            CURLOPT_TIMEOUT        => $this->timeout,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/x-www-form-urlencoded',
            ],
        ];

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $errors = curl_error($ch);

        curl_close($ch);

        if ($statusCode !== 200) {
            $errors = 'Response status code is ' . $statusCode;
        } elseif ($response !== false) {
            return $response;
        }

        return '{"success":false,"error-codes":[' . json_encode($errors) . ']}';
    }
}