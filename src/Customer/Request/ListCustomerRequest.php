<?php

namespace Iugu\Customer\Request;

use Iugu\Environment;
use Iugu\Customer;
use Iugu\Request\AbstractRequest;

/**
 * Class ListCustomerRequest
 *
 * @package Iugu\Customer\Request
 */
class ListCustomerRequest extends AbstractRequest
{

    private $filters;

    /**
     * ListCustomerRequest constructor.
     *
     * @param Environment $environment
     * @param Customer $customer
     */
    public function __construct(Environment $environment, $filters)
    {
        parent::__construct($environment);
        $this->filters = $filters;
    }

    /**
     * 
     * @throws \Iugu\Request\IuguRequestException
     */
    public function execute()
    {
        $url = $this->environment->getApiUrl() . "/customers";
        return $this->get($url, $this->filters, false);
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
