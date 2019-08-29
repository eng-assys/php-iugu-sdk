<?php

namespace Iugu\Plan;

use Iugu\Environment;
use Iugu\Plan;
use Iugu\Plan\Request\CreatePlanRequest;
use Iugu\Plan\Request\ListPlansRequest;
use Iugu\Plan\Request\RemovePlanRequest;
use Iugu\Plan\Request\SearchPlanRequest;
use Iugu\Plan\Request\SearchPlanByIdentifierRequest;
use Iugu\Plan\Request\UpdatePlanRequest;

/**
 * The IuguPlan SDK front-end;
 */
class IuguPlan
{
    private $environment;

    /**
     * Create an instance of IuguPlan choosing the environment where the
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
     * Create a customer payment method.
     *
     * @param string $plan
     *
     * @return Plan.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function createPlan(Plan $plan)
    {
        $createPlanRequest = new CreatePlanRequest($this->environment, $plan);
        return $createPlanRequest->execute();
    }

    /**
     * Changes the data of a Payment Method, any parameters not informed will not be changed.
     *
     * @param string $plan
     *
     * @return Plan.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function updatePlan(Plan $plan)
    {
        $updatePlanRequest = new UpdatePlanRequest($this->environment, $plan);
        return $updatePlanRequest->execute();
    }

    /**
     * Permanently removes a payment method from a customer..
     *
     * @param string $plan
     *
     * @return Plan.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function removePlan(Plan $plan)
    {
        $removePlanRequest = new RemovePlanRequest($this->environment, $plan);
        return $removePlanRequest->execute();
    }

    /**
     * Returns data from a Plan.
     *
     * @param string $plan
     *
     * @return Plan.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function searchPlan(Plan $plan)
    {
        $searchPlanRequest = new SearchPlanRequest($this->environment, $plan);
        return $searchPlanRequest->execute();
    }

    /**
     * Returns data from a Plan.
     *
     * @param string $plan
     *
     * @return Plan.
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function searchPlanByIdentifier(Plan $plan)
    {
        $searchPlanByIdentifierRequest = new SearchPlanByIdentifierRequest($this->environment, $plan);
        return $searchPlanByIdentifierRequest->execute();
    }

    /**
     * Returns a list of all plans for a given customer.
     *
     * @param $filters
     *
     * @return array
     *
     * @throws \Iugu\Request\IuguRequestException if anything gets wrong.
     *
     */
    public function listPlans($filters)
    {
        $listPlansRequest = new ListPlansRequest($this->environment, $filters);
        return $listPlansRequest->execute();
    }
}
