<?php

namespace Iugu\Subscription\Request;

use Iugu\Environment;
use Iugu\Subscription;
use Iugu\Plan;
use Iugu\Request\AbstractRequest;

/**
 * Class ChangePlanRequest
 *
 * @package Iugu\Subscription\Request
 */
class ChangePlanRequest extends AbstractRequest
{

    private $subscription;
    private $plan;

    /**
     * ChangePlanRequest constructor.
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
        $url = $this->environment->getApiUrl() . "/subscriptions/{$this->subscription->getId()}/change_plan/{$this->plan->getIdentifier()}";
        return $this->sendRequest('POST', $url);
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
