<?php

namespace Iugu\Customer\Request;

use Iugu\Environment;
use Iugu\Customer;
use Iugu\Request\AbstractRequest;

/**
 * Class UpdateCustomerRequest
 *
 * @package Iugu\Customer\Request
 */
class UpdateCustomerRequest extends AbstractRequest
{

    private $customer;

    /**
     * UpdateCustomerRequest constructor.
     *
     * @param Environment $environment
     * @param Customer $customer
     */
    public function __construct(Environment $environment, Customer $customer)
    {
        parent::__construct($environment);
        $this->customer = $customer;
    }

    /**
     * 
     * @throws \Iugu\Request\IuguRequestException
     */
    public function execute()
    {
        $url = $this->environment->getApiUrl() . "/customers/{$this->customer->getId()}";
        return $this->sendRequest('PUT', $url, $this->customer);
    }

    /**
     * @param $json
     *
     * @return Customer
     */
    protected function unserialize($json)
    {
        return Customer::fromJson($json);
    }
}
