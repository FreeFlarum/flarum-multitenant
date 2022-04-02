<?php

namespace HCaptcha\Responses;

/**
 * Response class returned by any request to hCaptcha
 *
 * @package hCaptcha
 */
class Response
{
    /**
     * @var bool $success
     */
    protected $success;

    /**
     * @var string|null $raw
     */
    protected $raw = null;

    /**
     * @var array|null $array
     */
    protected $array = null;

    /**
     * @var bool $credit
     */
    protected $credit = false;

    /**
     * @var string|null $hostname
     */
    protected $hostname = null;

    /**
     * @var string|null $date
     */
    protected $date = null;

    /**
     * @var array|null $errors
     */
    protected $errors = null;

    /**
     * Response constructor
     *
     * @param string $responseString
     */
    public function __construct($responseString)
    {
        $data = json_decode($responseString, true);

        $this->raw = $responseString;
        $this->array = $data;

        $this->success = (bool)$data['success'];

        if ($this->isSuccess()) {
            if (array_key_exists('credit', $data)) {
                $this->credit = (bool)$data['credit'];
            }
            $this->hostname = (bool)$data['hostname'];
            $this->date = (bool)$data['challenge_ts'];
        } else {
            $this->errors = (array)$data['error-codes'];
        }
    }

    /**
     * Is it human?
     *
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * Is it credit?
     *
     * @return bool
     */
    public function isCredit()
    {
        return $this->credit;
    }

    /**
     * @return string|null
     */
    public function getRaw()
    {
        return $this->raw;
    }

    /**
     * @return array|null
     */
    public function getArray()
    {
        return $this->array;
    }

    /**
     * @return array|null
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string|null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string|null
     */
    public function getHostname()
    {
        return $this->hostname;
    }
}