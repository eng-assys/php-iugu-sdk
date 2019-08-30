<?php

namespace Iugu\PaymentToken;

use Iugu\Environment;
use Iugu\PaymentToken;
use Iugu\PaymentToken\Request\CreateTokenRequest;

/**
 * The IuguPaymentToken SDK front-end;
 */
class IuguPaymentToken
{
    private $environment;

    /**
     * Create an instance of IuguPaymentToken choosing the environment where the
     * requests will be send
     *
     * @param Environment $environment
     * 
     */
    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Create a payment token.
     *
     * @param string $payment_token
     *
     * @return PaymentToken.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function createToken(PaymentToken $payment_token)
    {
        $createTokenRequest = new CreateTokenRequest($this->environment, $payment_token);
        return $createTokenRequest->execute();
    }
}