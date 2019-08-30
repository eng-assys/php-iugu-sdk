<?php

namespace Iugu;

/**
 * Class Payer
 *
 * @package Iugu
 */
class Payer implements \JsonSerializable
{

    /** @var string
     * CPF ou CNPJ do cliente.
     */
    private $cpf_cnpj;

    /** @var string
     * Nome (utilizado como sacado no boleto).
     */
    private $name;

    /** @var string
     * 
     * Prefixo (DDD) do telefone em dois dígitos.
     */
    private $phone_prefix;

    /** @var string
     * Telefone do cliente.
     */
    private $phone;

    /** @var string
     * Email do cliente
     */
    private $email;

    /** @var Address
     * Endereço do cliente
     */
    private $address;

    /**
     * @param $json
     *
     * @return Payer
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);
        $payer = new Payer();
        $payer->populate($object);
        return $payer;
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
    public function getCpfCnpj()
    {
        return $this->cpf_cnpj;
    }

    /**
     * @param $cpf_cnpj
     *
     * @return $this
     */
    public function setCpfCnpj($cpf_cnpj)
    {
        $this->cpf_cnpj = $cpf_cnpj;
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
    public function getPhonePrefix()
    {
        return $this->phone_prefix;
    }

    /**
     * @param $phone_prefix
     *
     * @return $this
     */
    public function setPhonePrefix($phone_prefix)
    {
        $this->phone_prefix = $phone_prefix;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param $address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

}
