<?php

namespace Iugu\PaymentMethod\Request;

use Iugu\Environment;
use Iugu\PaymentMethod;
use Iugu\Request\AbstractRequest;

/**
 * Class ListPaymentMethodRequest
 *
 * @package Iugu\PaymentMethod\Request
 */
class ListPaymentMethodRequest extends AbstractRequest
{

    private $customer_id;
    private $filters;

    /**
     * ListPaymentMethodRequest constructor.
     *
     * @param Environment $environment
     * @param PaymentMethod $customer
     */
    public function __construct(Environment $environment, $customer_id, $filters)
    {
        parent::__construct($environment);
        $this->customer_id = $customer_id;
        $this->filters = $filters;
    }

    /**
     * 
     * @throws \Iugu\Request\IuguRequestException
     */
    public function execute()
    {
        $url = $this->environment->getApiUrl() . "/customers/{$this->customer_id}/payment_methods";
        return $this->get($url, $this->filters, false);
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
