<?php

namespace Iugu\Subscription\Request;

use Iugu\Environment;
use Iugu\Subscription;
use Iugu\Request\AbstractRequest;

/**
 * Class RemoveSubscriptionRequest
 *
 * @package Iugu\Subscription\Request
 */
class RemoveSubscriptionRequest extends AbstractRequest
{

    private $subscription;

    /**
     * RemoveSubscriptionRequest constructor.
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
        $url = $this->environment->getApiUrl() . "/subscriptions/{$this->subscription->getId()}";
        return $this->sendRequest('DELETE', $url, $this->subscription);
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
