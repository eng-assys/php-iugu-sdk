<?php

namespace Iugu\Customer\Request;

use Iugu\Environment;
use Iugu\Customer;
use Iugu\Request\AbstractRequest;

/**
 * Class CancelCustomerRequest
 *
 * @package Iugu\Customer\Request
 */
class CreateCustomerRequest extends AbstractRequest
{

    private $customer;

    /**
     * CancelCustomerRequest constructor.
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
        $url = $this->environment->getApiUrl() . "/customers";
        return $this->sendRequest('POST', $url, $this->customer);
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
