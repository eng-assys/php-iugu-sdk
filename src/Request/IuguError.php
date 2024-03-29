<?php

namespace Iugu\Request;

/**
 * Class IuguError
 *
 * @package Iugu\Request
 */
class IuguError
{

    private $code;

    private $message;

    /**
     * IuguError constructor.
     *
     * @param $message
     * @param $code
     */
    public function __construct($message, $code)
    {
        $this->setMessage($message);
        $this->setCode($code);
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param $message
     *
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
}
