<?php

namespace Iugu;

/**
 * Class PaymentMethod
 *
 * @package Iugu
 */
class PaymentMethod implements \JsonSerializable
{

    /** @var string
     * ID da forma de pagamento.
     */
    private $id;

    /** @var string
     * ID do Cliente
     */
    private $customer_id;

    /** @var string
     * Descrição
     */
    private $description;

    /** @var string
     * Token de Pagamento
     */
    private $token;

    /** @var string
     * Se "true" define esta Forma de Pagamento como padrão do Cliente, 
     * ou seja, para executar cobranças automáticas no cartão salvo.
     */
    private $set_as_default;

    /**
     * @param $json
     *
     * @return PaymentMethod
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);
        $payment_method = new PaymentMethod();
        $payment_method->populate($object);
        return $payment_method;
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
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @param $customer_id
     *
     * @return $this
     */
    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param $token
     *
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getSetAsDefault()
    {
        return $this->set_as_default;
    }

    /**
     * @param $set_as_default
     *
     * @return $this
     */
    public function setSetAsDefault($set_as_default)
    {
        $this->set_as_default = $set_as_default;
        return $this;
    }
}
