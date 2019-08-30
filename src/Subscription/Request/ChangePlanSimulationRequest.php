<?php

namespace Iugu\Subscription\Request;

use Iugu\Environment;
use Iugu\Subscription;
use Iugu\Plan;
use Iugu\Request\AbstractRequest;

/**
 * Class ChangePlanSimulationRequest
 *
 * @package Iugu\Subscription\Request
 */
class ChangePlanSimulationRequest extends AbstractRequest
{

    private $subscription;
    private $plan;

    /**
     * ChangePlanSimulationRequest constructor.
     *
     * @param Environment $environment
     * @param Subscription $subscription
     */
    public function __construct(Environment $environment, Subscription $subscription, Plan $plan)
    {
        parent::__construct($environment);
        $this->subscription = $subscription;
        $this->plan = $plan;
    }

    /**
     * 
     * @throws \Iugu\Request\IuguRequestException
     */
    public function execute()
    {
        $url = $this->environment->getApiUrl() . "/subscriptions/{$this->subscription->getId()}/change_plan_simulation/{$this->plan->getIdentifier()}";
        return $this->get($url, [], false);
    }

    /**
     * @param $json
     *
     * @return Subscription
     */
    protected function unserialize($json)
    {
        return Subscription::fromJson($json);
    }
}
