<?php

namespace Iugu\PaymentMethod\Request;

use Iugu\Environment;
use Iugu\PaymentMethod;
use Iugu\Request\AbstractRequest;

/**
 * Class UpdatePaymentMethodRequest
 *
 * @package Iugu\PaymentMethod\Request
 */
class UpdatePaymentMethodRequest extends AbstractRequest
{

    private $payment_method;

    /**
     * UpdatePaymentMethodRequest constructor.
     *
     * @param Environment $environment
     * @param PaymentMethod $payment_method
     */
    public function __construct(Environment $environment, PaymentMethod $payment_method)
    {
        parent::__construct($environment);
        $this->payment_method = $payment_method;
    }

    /**
     * 
     * @throws \Iugu\Request\IuguRequestException
     */
    public function execute()
    {
        $url = $this->environment->getApiUrl() . "/customers/{$this->payment_method->getCustomerId()}/payment_methods/{$this->payment_method->getId()}";
        return $this->sendRequest('PUT', $url, $this->payment_method);
    }

    /**
     * @param $json
     *
     * @return PaymentMethod
     */
    protected function unserialize($json)
    {
        return PaymentMethod::fromJson($json);
    }
}
