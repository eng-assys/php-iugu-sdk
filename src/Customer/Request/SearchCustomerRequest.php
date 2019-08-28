<?php

namespace Iugu\Customer\Request;

use Iugu\Environment;
use Iugu\Customer;
use Iugu\Request\AbstractRequest;

/**
 * Class SearchCustomerRequest
 *
 * @package Iugu\Customer\Request
 */
class SearchCustomerRequest extends AbstractRequest
{

    private $customer;

    /**
     * SearchCustomerRequest constructor.
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
        return $this->sendRequest('GET', $url);
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
