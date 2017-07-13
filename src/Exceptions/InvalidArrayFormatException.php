<?php

namespace ChrisHalbert\PhpBCC\Exceptions;

/**
 * Class FileNotFoundException
 * @package ChrisHalbert\PhpBCC\Exceptions
 */
class InvalidArrayFormatException extends \Exception implements ExceptionInterface
{
    /**
     * FileNotFoundException constructor.
     * @param string $message Command failed message.
     */
    public function __construct(string $message = 'Invalid array format.')
    {
        return parent::__construct($message, 400);
    }
}
