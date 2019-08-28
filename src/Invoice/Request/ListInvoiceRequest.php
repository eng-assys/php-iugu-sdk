<?php

namespace Iugu\Invoice\Request;

use Iugu\Environment;
use Iugu\Invoice;
use Iugu\Request\AbstractRequest;

/**
 * Class ListInvoiceRequest
 *
 * @package Iugu\Invoice\Request
 */
class ListInvoiceRequest extends AbstractRequest
{

    private $filters;

    /**
     * ListInvoiceRequest constructor.
     *
     * @param Environment $environment
     * @param Array $filters
     */
    public function __construct(Environment $environment, $filters)
    {
        parent::__construct($environment);
        $this->filters = $filters;
    }

    /**
     * @param string $invoice_id
     *
     * @return null
     * @throws \Iugu\Request\IuguRequestException
     */
    public function execute()
    {
        $url = $this->environment->getApiUrl() . "/invoices";
        return $this->get($url, $this->filters, false);
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
