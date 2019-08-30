<?php

namespace Iugu\Subscription\Request;

use Iugu\Environment;
use Iugu\Subscription;
use Iugu\Request\AbstractRequest;

/**
 * Class RemoveCreditsRequest
 *
 * @package Iugu\Subscription\Request
 */
class RemoveCreditsRequest extends AbstractRequest
{

    private $subscription;
    private $quantity;

    /**
     * RemoveCreditsRequest constructor.
     *
     * @param Environment $environment
     * @param Subscription $subscription
     */
    public function __construct(Environment $environment, Subscription $subscription, $quantity)
    {
        parent::__construct($environment);
        $this->subscription = $subscription;
        $this->quantity = $quantity;
    }

    /**
     * 
     * @throws \Iugu\Request\IuguRequestException
     */
    public function execute()
    {
        $url = $this->environment->getApiUrl() . "/subscriptions/{$this->subscription->getId()}/remove_credits";
        return $this->put($url, ['quantity' => $this->quantity], [], false);
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
