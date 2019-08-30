<?php

namespace Iugu\Subscription\Request;

use Iugu\Environment;
use Iugu\Subscription;
use Iugu\Request\AbstractRequest;

/**
 * Class ActivateSubscriptionRequest
 *
 * @package Iugu\Subscription\Request
 */
class ActivateSubscriptionRequest extends AbstractRequest
{

    private $subscription;

    /**
     * ActivateSubscriptionRequest constructor.
     *
     * @param Environment $environment
     * @param Subscription $subscription
     */
    public function __construct(Environment $environment, Subscription $subscription)
    {
        parent::__construct($environment);
        $this->subscription = $subscription;
    }

    /**
     * 
     * @throws \Iugu\Request\IuguRequestException
     */
    public function execute()
    {
        $url = $this->environment->getApiUrl() . "/subscriptions/{$this->subscription->getId()}/activate";
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
