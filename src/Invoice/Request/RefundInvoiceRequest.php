<?php

namespace Iugu\Invoice\Request;

use Iugu\Environment;
use Iugu\Invoice;
use Iugu\Request\AbstractRequest;

/**
 * Class RefundInvoiceRequest
 *
 * @package Iugu\Invoice\Request
 */
class RefundInvoiceRequest extends AbstractRequest
{

    private $invoice;

    /**
     * RefundInvoiceRequest constructor.
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
     * @param string $invoice_id
     *
     * @return null
     * @throws \Iugu\Request\IuguRequestException
     */
    public function execute()
    {
        $url = $this->environment->getApiUrl() . "/invoices/{$this->invoice->getId()}/refund";
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
