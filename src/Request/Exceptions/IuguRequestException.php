<?php

namespace Iugu\Request\Exceptions;

/**
 * Class IuguRequestException
 *
 * @package Iugu\Request
 */
class IuguRequestException extends \Exception
{

    private $iuguError;

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
        return $this->iuguError;
    }

    /**
     * @param $iuguError
     *
     * @return $this
     */
    public function setIuguError($iuguError)
    {
        $this->iuguError = $iuguError;
        return $this;
    }
}
