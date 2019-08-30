<?php

namespace Iugu\Subscription\Request;

use Iugu\Environment;
use Iugu\Subscription;
use Iugu\Request\AbstractRequest;

/**
 * Class ListSubscriptionsRequest
 *
 * @package Iugu\Subscription\Request
 */
class ListSubscriptionsRequest extends AbstractRequest
{

    private $filters;

    /**
     * ListSubscriptionsRequest constructor.
     *
     * @param Environment $environment
     * @param Subscription $subscription
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
        $url = $this->environment->getApiUrl() . "/subscriptions";
        return $this->get($url, $this->filters, false);
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
