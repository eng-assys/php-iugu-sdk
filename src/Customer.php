<?php

namespace Iugu;

/**
 * Class Customer
 *
 * @package Iugu
 */
class Customer implements \JsonSerializable
{

    /** @var string
     * Id do cliente
     */
    private $id;

    /** @var string
     * Email do cliente
     */
    private $email;

    /** @var string
     * Nome (utilizado como sacado no boleto).
     */
    private $name;

    /** @var string
     * Notas.
     */
    private $notes;

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
     * CPF ou CNPJ do cliente
     */
    private $cpf_cnpj;

    /** @var string
     * Endereços de E-mail para cópia separados por vírgula.
     */
    private $cc_emails;

    /** @var string
     * CEP.
     */
    private $zip_code;

    /** @var string
     * Logradouro.
     */
    private $street;

    /** @var string
     * 
     * Número.
     */
    private $number;

    /** @var string
     * Bairro.
     */
    private $district;

    /** @var string
     * Cidade.
     */
    private $city;

    /** @var string
     * Estado.
     */
    private $state;

    /** @var string
     * País.
     */
    private $country;

    /** @var string
     * Complemento/
     */
    private $complement;

    /** @var array
     * Variaveis personalizadas.
     */
    private $custom_variables;

    /** @var string
     * Variaveis personalizadas.
     */
    private $default_payment_method_id;

    /**
     * @param $json
     *
     * @return Customer
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);
        $customer = new Customer();
        $customer->populate($object);
        return $customer;
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
    public function getZipCode()
    {
        return $this->zip_code;
    }

    /**
     * @param $zip_code
     *
     * @return $this
     */
    public function setZipCode($zip_code)
    {
        $this->zip_code = $zip_code;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param $street
     *
     * @return $this
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param $number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param $district
     *
     * @return $this
     */
    public function setDistrict($district)
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param $state
     *
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * @param $complement
     *
     * @return $this
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param $notes
     *
     * @return $this
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * @return string
     */
    public function getCcEmail()
    {
        return $this->cc_emails;
    }

    /**
     * @param $cc_emails
     *
     * @return $this
     */
    public function setCcEmail($cc_emails)
    {
        $this->cc_emails = $cc_emails;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomVariables()
    {
        return $this->custom_variables;
    }

    /**
     * @param $custom_variables
     *
     * @return $this
     */
    public function setCustomVariables($custom_variables)
    {
        $this->custom_variables = $custom_variables;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultPaymentMethodId()
    {
        return $this->default_payment_method_id;
    }

    /**
     * @param $default_payment_method_id
     *
     * @return $this
     */
    public function setDefaultPaymentMethodId($default_payment_method_id)
    {
        $this->default_payment_method_id = $default_payment_method_id;
        return $this;
    }
}
