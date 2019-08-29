<?php

namespace Iugu\Plan\Request;

use Iugu\Environment;
use Iugu\Plan;
use Iugu\Request\AbstractRequest;

/**
 * Class SearchPlanByIdentifierRequest
 *
 * @package Iugu\Plan\Request
 */
class SearchPlanByIdentifierRequest extends AbstractRequest
{

    private $plan;

    /**
     * SearchPlanByIdentifierRequest constructor.
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
        $url = $this->environment->getApiUrl() . "/plans/identifier/{$this->plan->getIdentifier()}";
        return $this->sendRequest('GET', $url);
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
