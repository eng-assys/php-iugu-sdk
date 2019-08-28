<?php

namespace Iugu\Invoice\Request;

use Iugu\Environment;
use Iugu\Invoice;
use Iugu\Request\AbstractRequest;

/**
 * Class CreateInvoiceRequest
 *
 * @package Iugu\Invoice\Request
 */
class CreateInvoiceRequest extends AbstractRequest
{

    private $invoice;

    /**
     * CreateInvoiceRequest constructor.
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
        $url = $this->environment->getApiUrl() . "/invoices";
        return $this->sendRequest('POST', $url, $this->invoice);
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
