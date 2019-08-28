<?php

namespace Iugu\Invoice\Request;

use Iugu\Environment;
use Iugu\Invoice;
use Iugu\Request\AbstractRequest;

/**
 * Class CaptureInvoiceRequest
 *
 * @package Iugu\Invoice\Request
 */
class CaptureInvoiceRequest extends AbstractRequest
{

    private $invoice;

    /**
     * CaptureInvoiceRequest constructor.
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
        $url = $this->environment->getApiUrl() . "/invoices/{$this->invoice->getId()}/capture";
        return $this->sendRequest('POST', $url);
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
