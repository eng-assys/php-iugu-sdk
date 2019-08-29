<?php

namespace Iugu\Plan\Request;

use Iugu\Environment;
use Iugu\Plan;
use Iugu\Request\AbstractRequest;

/**
 * Class ListPlansRequest
 *
 * @package Iugu\Plan\Request
 */
class ListPlansRequest extends AbstractRequest
{

    private $filters;

    /**
     * ListPlansRequest constructor.
     *
     * @param Environment $environment
     * @param Plan $customer
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
        $url = $this->environment->getApiUrl() . "/plans";
        return $this->get($url, $this->filters, false);
    }

    /**
     * @param $json
     *
     * @return Plan
     */
    protected function unserialize($json)
    {
        return Plan::fromJson($json);
    }
}
