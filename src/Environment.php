<?php

namespace Iugu;

/**
 * Class Environment
 *
 * @package Iugu\Split\API
 */
class Environment
{

    private $api_url = "https://api.iugu.com/v1";

    private $api_token;

    /**
     * Environment constructor.
     *
     * @param $api
     */
    public function __construct($api_token)
    {
        $this->api_token = $api_token;
    }

    /**
     * Gets the environment's Api URL
     *
     * @return string the Api URL
     */
    public function getApiUrl()
    {
        return $this->api_url;
    }

    /**
     * Gets the Iugu API Token
     *
     * @return string the API token on Iugu
     */
    public function getApiToken()
    {
        return $this->api_token;
    }
}
