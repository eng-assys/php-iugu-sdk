<?php

namespace Iugu\Invoice\Request;

use Iugu\Environment;
use Iugu\Invoice;
use Iugu\Request\AbstractRequest;

/**
 * Class CancelInvoiceRequest
 *
 * @package Iugu\Invoice\Request
 */
class CancelInvoiceRequest extends AbstractRequest
{

    private $invoice;

    /**
     * CancelInvoiceRequest constructor.
     *
     * @param Environment $environment
     * @param Invoice $invoice
     */
    public function __construct(Environment $environment, Invoice $invoice)
    {
        parent::__construct($environment);
        $this->invoice = $invoice;
    }

    /**
     * 
     * @throws \Iugu\Request\IuguRequestException
     */
    public function execute()
    {
        $url = $this->environment->getApiUrl() . "/invoices/{$this->invoice->getId()}/cancel";
        return $this->sendRequest('PUT', $url);
    }

    /**
     * @param $json
     *
     * @return Invoice
     */
    protected function unserialize($json)
    {
        return Invoice::fromJson($json);
    }
}
