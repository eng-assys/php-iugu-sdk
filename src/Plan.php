<?php

namespace Iugu;

/**
 * Class Plan
 *
 * @package Iugu
 */
class Plan implements \JsonSerializable
{

    /** @var string
     * Id do plano.
     */
    private $id;

    /** @var string
     * Nome do plano.
     */
    private $name;

    /** @var string
     * Identificador do plano.
     */
    private $identifier;

    /** @var int
     * Ciclo do plano (Número inteiro maior que 0). Intervalo até a próxima cobrança.
     */
    private $interval;

    /** @var string
     * Tipo de interval ("weeks" ou "months").
     */
    private $interval_type;

    /** @var int
     * Preço do plano em centavos.
     */
    private $value_cents;

    /** @var string
     * Método de pagamento que será disponibilizado para as faturas pertencentes a 
     * assinaturas deste plano ('all', 'credit_card' ou 'bank_slip').
     */
    private $payable_with;

    /** @var array
     * Features do plano.
     */
    private $features;

    /** @var array
     * 
     */
    private $prices;

    /**
     * @param $json
     *
     * @return Plan
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);
        $plan = new Plan();
        $plan->populate($object);
        return $plan;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }

    /**
     * @param \stdClass $data
     */
    public function populate(\stdClass $data)
    {
        foreach (get_object_vars($this) as $key => $value) {
            $this->{$key} = $data->{$key} ?? null;
        }
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param $identifier
     *
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * @param $interval
     *
     * @return $this
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
        return $this;
    }

    /**
     * @return string
     */
    public function getInterval_type()
    {
        return $this->interval_type;
    }

    /**
     * @param $interval_type
     *
     * @return $this
     */
    public function setInterval_type($interval_type)
    {
        $this->interval_type = $interval_type;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue_cents()
    {
        return $this->value_cents;
    }

    /**
     * @param $value_cents
     *
     * @return $this
     */
    public function setValue_cents($value_cents)
    {
        $this->value_cents = $value_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getPayable_with()
    {
        return $this->payable_with;
    }

    /**
     * @param $payable_with
     *
     * @return $this
     */
    public function setPayable_with($payable_with)
    {
        $this->payable_with = $payable_with;
        return $this;
    }

    /**
     * @return string
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @param $features
     *
     * @return $this
     */
    public function setFeatures($features)
    {
        $this->features = $features;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @param $prices
     *
     * @return $this
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;
        return $this;
    }

}
