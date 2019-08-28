<?php

namespace Iugu\Request\Exceptions;

/**
 * Class IuguUnprocessableEntityException
 *
 * @package Iugu\Request
 */
class IuguUnprocessableEntityException extends IuguRequestException
{

    private $iugu_error;

    /**
     * IuguRequestException constructor.
     *
     * @param string $message
     * @param int    $code
     * @param null   $previous
     */
    public function __construct($message, $code, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return mixed
     */
    public function getIuguError()
    {
        return $this->iugu_error;
    }

    /**
     * @param $iugu_error
     *
     * @return $this
     */
    public function setIuguError($iugu_error)
    {
        $this->iugu_error = $iugu_error;
        return $this;
    }
}
