<?php

namespace Iugu\PaymentMethod;

use Iugu\Environment;
use Iugu\PaymentMethod;
use Iugu\PaymentMethod\Request\CreatePaymentMethodRequest;
use Iugu\PaymentMethod\Request\ListPaymentMethodRequest;
use Iugu\PaymentMethod\Request\RemovePaymentMethodRequest;
use Iugu\PaymentMethod\Request\SearchPaymentMethodRequest;
use Iugu\PaymentMethod\Request\UpdatePaymentMethodRequest;

/**
 * The Iugu PaymentMethod SDK front-end;
 */
class IuguPaymentMethod
{
    private $environment;

    /**
     * Create an instance of IuguPaymentMethod choosing the environment where the
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
     * Create a customer payment method.
     *
     * @param string $payment_method_id
     *
     * @return PaymentMethod.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function createPaymentMethod(PaymentMethod $payment_method)
    {
        $createPaymentMethodRequest = new CreatePaymentMethodRequest($this->environment, $payment_method);
        return $createPaymentMethodRequest->execute();
    }

    /**
     * Changes the data of a Payment Method, any parameters not informed will not be changed.
     *
     * @param string $payment_method_id
     *
     * @return PaymentMethod.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function updatePaymentMethod(PaymentMethod $payment_method)
    {
        $updatePaymentMethodRequest = new UpdatePaymentMethodRequest($this->environment, $payment_method);
        return $updatePaymentMethodRequest->execute();
    }

    /**
     * Permanently removes a payment method from a customer..
     *
     * @param string $payment_method_id
     *
     * @return PaymentMethod.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function removePaymentMethod(PaymentMethod $payment_method)
    {
        $removePaymentMethodRequest = new RemovePaymentMethodRequest($this->environment, $payment_method);
        return $removePaymentMethodRequest->execute();
    }

    /**
     * Returns data from a Customer Payment Method.
     *
     * @param string $payment_method_id
     *
     * @return PaymentMethod.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function searchPaymentMethod(PaymentMethod $payment_method)
    {
        $searchPaymentMethodRequest = new SearchPaymentMethodRequest($this->environment, $payment_method);
        return $searchPaymentMethodRequest->execute();
    }

    /**
     * Returns a list of all payment methods for a given customer.
     *
     * @param $customer_id
     * @param $filters
     *
     * @return array
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function listPaymentMethods($customer_id, $filters)
    {
        $listPaymentMethodsRequest = new ListPaymentMethodRequest($this->environment, $customer_id, $filters);
        return $listPaymentMethodsRequest->execute();
    }
}
