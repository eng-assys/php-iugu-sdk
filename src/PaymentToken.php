<?php

namespace Iugu;

/**
 * Class PaymentToken
 *
 * @package Iugu
 */
class PaymentToken implements \JsonSerializable
{

    /**
     * @var string
     * ID do método de pagamento.
     */
    private $id;

    /**
     * @var string
     * ID de sua Conta na Iugu.
     */
    private $account_id;

    /**
     * @var string
     * Método de Pagamento.
     */
    private $method;

    /**
     * @var bool
     * Valor true para criar tokens de teste.
     */
    private $test;

    /**
     * @var string
     */
    private $data;

    /**
     * @var string
     */
    private $extra_info;

    /**
     * @param $json
     *
     * @return PaymentToken
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);
        $payment_token = new PaymentToken();
        $payment_token->populate($object);
        return $payment_token;
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
    public function getAccountId()
    {
        return $this->account_id;
    }

    /**
     * @param $account_id
     *
     * @return $this
     */
    public function setAccountId($account_id)
    {
        $this->account_id = $account_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param $method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return string
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param $test
     *
     * @return $this
     */
    public function setTest($test)
    {
        $this->test = $test;
        return $this;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return object
     */
    public function getExtraInfo()
    {
        return $this->extra_info;
    }

    /**
     * @param $extra_info
     *
     * @return $this
     */
    public function setExtraInfo($extra_info)
    {
        $this->extra_info = $extra_info;
        return $this;
    }
}
