<?php

namespace Iugu\Invoice\Request;

use Iugu\Environment;
use Iugu\Invoice;
use Iugu\Request\AbstractRequest;

/**
 * Class DuplicateInvoiceRequest
 *
 * @package Iugu\Invoice\Request
 */
class DuplicateInvoiceRequest extends AbstractRequest
{

    private $invoice;
    private $params;

    /**
     * DuplicateInvoiceRequest constructor.
     *
     * @param Environment $environment
     * @param Invoice $invoice
     * @param Array $params
     */
    public function __construct(Environment $environment, Invoice $invoice, $params)
    {
        parent::__construct($environment);
        $this->invoice = $invoice;
        $this->params = $params;
    }

    /**
     * @param string $invoice_id
     *
     * @return null
     * @throws \Iugu\Request\IuguRequestException
     */
    public function execute()
    {
        $url = $this->environment->getApiUrl() . "/invoices/{$this->invoice->getId()}/duplicate";
        return $this->post($url, $this->params);
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
