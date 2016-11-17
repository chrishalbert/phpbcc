<?php

namespace ChrisHalbert\PhpBCC\Exceptions;

/**
 * Interface ExceptionInterface
 * @package ChrisHalbert\PhpBCC\Exceptions
 */
interface ExceptionInterface
{
    /**
     * Returns the exception message.
     * @return string
     */
    public function getMessage();

    /**
     * Returns the exception code.
     * @return integer
     */
    public function getCode();
}
