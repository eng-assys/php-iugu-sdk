<?php

namespace Iugu\Plan\Request;

use Iugu\Environment;
use Iugu\Plan;
use Iugu\Request\AbstractRequest;

/**
 * Class UpdatePlanRequest
 *
 * @package Iugu\Plan\Request
 */
class UpdatePlanRequest extends AbstractRequest
{

    private $plan;

    /**
     * UpdatePlanRequest constructor.
     *
     * @param Environment $environment
     * @param Plan $plan
     */
    public function __construct(Environment $environment, Plan $plan)
    {
        parent::__construct($environment);
        $this->plan = $plan;
    }

    /**
     * 
     * @throws \Iugu\Request\IuguRequestException
     */
    public function execute()
    {
        $url = $this->environment->getApiUrl() . "/plans/{$this->plan->getId()}";
        return $this->sendRequest('PUT', $url, $this->plan);
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
