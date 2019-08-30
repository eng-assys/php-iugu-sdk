<?php

namespace Iugu\PaymentToken\Request;

use Iugu\Environment;
use Iugu\PaymentToken;
use Iugu\Request\AbstractRequest;

/**
 * Class CreateTokenRequest
 *
 * @package Iugu\PaymentToken\Request
 */
class CreateTokenRequest extends AbstractRequest
{

    private $payment_token;

    /**
     * CreateTokenRequest constructor.
     *
     * @param Environment $environment
     * @param PaymentToken $payment_token
     */
    public function __construct(Environment $environment, PaymentToken $payment_token)
    {
        parent::__construct($environment);
        $this->payment_token = $payment_token;
    }

    /**
     * 
     * @throws \Iugu\Request\IuguRequestException
     */
    public function execute()
    {
        $url = $this->environment->getApiUrl() . "/payment_token";
        return $this->sendRequest('POST', $url, $this->payment_token);
    }

    /**
     * @param $json
     *
     * @return PaymentToken
     */
    protected function unserialize($json)
    {
        return PaymentToken::fromJson($json);
    }
}
