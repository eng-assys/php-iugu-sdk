<?php

namespace Iugu\Invoice;

use Iugu\Environment;
use Iugu\Invoice;
use Iugu\Invoice\Request\CancelInvoiceRequest;
use Iugu\Invoice\Request\CaptureInvoiceRequest;
use Iugu\Invoice\Request\CreateInvoiceRequest;
use Iugu\Invoice\Request\DuplicateInvoiceRequest;
use Iugu\Invoice\Request\ListInvoiceRequest;
use Iugu\Invoice\Request\RefundInvoiceRequest;
use Iugu\Invoice\Request\SearchInvoiceRequest;
use Iugu\Invoice\Request\SendInvoiceEmailRequest;

/**
 * The Iugu Invoice SDK front-end;
 */
class IuguInvoice
{
    private $environment;

    /**
     * Create an instance of IuguInvoice choosing the environment where the
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
     * Cancel the Invoice.
     *
     * @param string $invoice_id
     *
     * @return Invoice.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function cancelInvoice(Invoice $invoice)
    {
        $cancelInvoiceRequest = new CancelInvoiceRequest($this->environment, $invoice);
        return $cancelInvoiceRequest->execute();
    }

    /**
     * Capture the Invoice with status "in_analysis"
     *
     * @param string $invoice_id
     *
     * @return Invoice.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function captureInvoice(Invoice $invoice)
    {
        $captureInvoiceRequest = new CaptureInvoiceRequest($this->environment, $invoice);
        return $captureInvoiceRequest->execute();
    }

    /**
     * Create a Invoice for a Client.
     *
     * @param string $invoice_id
     *
     * @return Invoice.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function createInvoice(Invoice $invoice)
    {
        $createInvoiceRequest = new CreateInvoiceRequest($this->environment, $invoice);
        return $createInvoiceRequest->execute();
    }

    /**
     * Duplicate a invoice with status "pending". The invoice is canceled and another is created with the same status.
     *
     * @param string $invoice_id
     *
     * @return Invoice.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function duplicateInvoice(Invoice $invoice, $params)
    {
        $duplicateInvoiceRequest = new DuplicateInvoiceRequest($this->environment, $invoice, $params);
        return $duplicateInvoiceRequest->execute();
    }

    /**
     *
     * @param $filters
     *
     * @return array
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function listInvoices($filters)
    {
        $listInvoicesRequest = new ListInvoiceRequest($this->environment, $filters);
        return $listInvoicesRequest->execute();
    }

    /**
     *
     * @param string $invoice_id
     *
     * @return Invoice $invoice
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function refundInvoice(Invoice $invoice)
    {
        $refundInvoicesRequest = new refundInvoiceRequest($this->environment, $invoice);
        return $refundInvoicesRequest->execute();
    }

    /**
     *
     * @param string $invoice_id
     *
     * @return Invoice $invoice
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function searchInvoice(Invoice $invoice)
    {
        $searchInvoicesRequest = new searchInvoiceRequest($this->environment, $invoice);
        return $searchInvoicesRequest->execute();
    }

    /**
     *
     * @param string $invoice_id
     *
     * @return Invoice $invoice
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function sendInvoiceEmail(Invoice $invoice)
    {
        $sendInvoiceEmailRequest = new SendInvoiceEmailRequest($this->environment, $invoice);
        return $sendInvoiceEmailRequest->execute();
    }
}
