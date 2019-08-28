<?php

namespace Iugu\Customer;

use Iugu\Environment;
use Iugu\Customer;
use Iugu\Customer\Request\CreateCustomerRequest;
use Iugu\Customer\Request\UpdateCustomerRequest;
use Iugu\Customer\Request\RemoveCustomerRequest;
use Iugu\Customer\Request\SearchCustomerRequest;
use Iugu\Customer\Request\ListCustomerRequest;

/**
 * The Iugu Customer SDK front-end;
 */
class IuguCustomer
{
    private $environment;

    /**
     * Create an instance of IuguCustomer choosing the environment where the
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
     * Create a Customer.
     *
     * @param string $customer_id
     *
     * @return Customer.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function createCustomer(Customer $customer)
    {
        $createCustomerRequest = new CreateCustomerRequest($this->environment, $customer);
        return $createCustomerRequest->execute();
    }

    /**
     * Change a customer's data. Any parameters not entered will not be changed.
     *
     * @param string $customer_id
     *
     * @return Customer.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function updateCustomer(Customer $customer)
    {
        $updateCustomerRequest = new UpdateCustomerRequest($this->environment, $customer);
        return $updateCustomerRequest->execute();
    }

    /**
     * Permanently remove a customer. However, it does not allow you to remove customers with linked signatures or invoices.
     *
     * @param string $customer_id
     *
     * @return Customer.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function removeCustomer(Customer $customer)
    {
        $removeCustomerRequest = new RemoveCustomerRequest($this->environment, $customer);
        return $removeCustomerRequest->execute();
    }

    /**
     * Return data from a customer.
     *
     * @param string $customer_id
     *
     * @return Customer.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function searchCustomer(Customer $customer)
    {
        $searchCustomerRequest = new SearchCustomerRequest($this->environment, $customer);
        return $searchCustomerRequest->execute();
    }

    /**
     * @param $filters
     *
     * @return array
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function listCustomers($filters)
    {
        $listCustomersRequest = new ListCustomerRequest($this->environment, $filters);
        return $listCustomersRequest->execute();
    }
}
