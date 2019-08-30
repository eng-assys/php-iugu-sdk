<?php

namespace Iugu\Subscription;

use Iugu\Environment;
use Iugu\Plan;
use Iugu\Subscription;
use Iugu\Subscription\Request\ActivateSubscriptionRequest;
use Iugu\Subscription\Request\CreateSubscriptionRequest;
use Iugu\Subscription\Request\SuspendSubscriptionRequest;
use Iugu\Subscription\Request\UpdateSubscriptionRequest;
use Iugu\Subscription\Request\ChangePlanSimulationRequest;
use Iugu\Subscription\Request\ChangePlanRequest;
use Iugu\Subscription\Request\AddCreditsRequest;
use Iugu\Subscription\Request\ListSubscriptionsRequest;
use Iugu\Subscription\Request\RemoveCreditsRequest;
use Iugu\Subscription\Request\RemoveSubscriptionRequest;
use Iugu\Subscription\Request\SearchSubscriptionRequest;

/**
 * The IuguSubscription SDK front-end;
 */
class IuguSubscription
{
    private $environment;

    /**
     * Create an instance of IuguSubscription choosing the environment where the
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
     * Create a subscription.
     *
     * @param string $subscription
     *
     * @return Subscription.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function createSubscription(Subscription $subscription)
    {
        $createSubscriptionRequest = new CreateSubscriptionRequest($this->environment, $subscription);
        return $createSubscriptionRequest->execute();
    }

    /**
     * Activates a Subscription. An Invoice may be generated for the customer.
     *
     * @param string $subscription
     *
     * @return Subscription.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function activateSubscription(Subscription $subscription)
    {
        $activateSubscriptionRequest = new ActivateSubscriptionRequest($this->environment, $subscription);
        return $activateSubscriptionRequest->execute();
    }

    /**
     * Suspends a Subscription.
     *
     * @param string $subscription
     *
     * @return Subscription.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function suspendSubscription(Subscription $subscription)
    {
        $suspendSubscriptionRequest = new SuspendSubscriptionRequest($this->environment, $subscription);
        return $suspendSubscriptionRequest->execute();
    }

    /**
     * Changes the data of a Subscription, any parameters not informed will not be changed.
     *
     * @param string $subscription
     *
     * @return Subscription.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function updateSubscription(Subscription $subscription)
    {
        $updateSubscriptionRequest = new UpdateSubscriptionRequest($this->environment, $subscription);
        return $updateSubscriptionRequest->execute();
    }

    /**
     * Simulates the plan change of a subscription.
     *
     * @param string $subscription
     *
     * @return Subscription.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function changePlanSimulation(Subscription $subscription, Plan $plan)
    {
        $changePlanSimulationRequest = new ChangePlanSimulationRequest($this->environment, $subscription, $plan);
        return $changePlanSimulationRequest->execute();
    }

    /**
     * Changes the plan of a subscription. An Invoice charging the plan change may be generated for the customer.
     *
     * @param string $subscription
     *
     * @return Subscription.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function changePlan(Subscription $subscription, Plan $plan)
    {
        $changePlanRequest = new ChangePlanRequest($this->environment, $subscription, $plan);
        return $changePlanRequest->execute();
    }

    /**
     * Add credits to a subscription.
     *
     * @param $filters
     *
     * @return array
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function addCredits(Subscription $subscription, $credits)
    {
        $addCreditsRequest = new AddCreditsRequest($this->environment, $subscription, $credits);
        return $addCreditsRequest->execute();
    }

    /**
     * Remove credits of a subscription.
     *
     * @param $filters
     *
     * @return array
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function removeCredits(Subscription $subscription, $credits)
    {
        $removeCreditsRequest = new RemoveCreditsRequest($this->environment, $subscription, $credits);
        return $removeCreditsRequest->execute();
    }

    /**
     * Removes a subscription permanently.
     *
     * @param $filters
     *
     * @return array
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function removeSubscription(Subscription $subscription)
    {
        $removeSubscriptionRequest = new RemoveSubscriptionRequest($this->environment, $subscription);
        return $removeSubscriptionRequest->execute();
    }

    /**
     * Returns the data of a Subscription.
     *
     * @param $filters
     *
     * @return array
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function searchSubscription(Subscription $subscription)
    {
        $searchSubscriptionRequest = new SearchSubscriptionRequest($this->environment, $subscription);
        return $searchSubscriptionRequest->execute();
    }

    /**
     * Returns a list of signatures generated by your account, 
     * sorted by date created from newest to oldest. The totalItems 
     * node always returns the total number of subscriptions registered, 
     * regardless of the search parameters used, and the search 
     * result is always within items. By default, returns a maximum
     * of 100 items.
     *
     * @param $filters
     *
     * @return array
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function listSubscription($filters)
    {
        $listSubscriptionsRequest = new ListSubscriptionsRequest($this->environment, $filters);
        return $listSubscriptionsRequest->execute();
    }
}
