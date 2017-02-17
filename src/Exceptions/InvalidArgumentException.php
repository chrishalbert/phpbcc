<?php

namespace ChrisHalbert\PhpBCC\Exceptions;

/**
 * Class FileNotFoundException
 * @package ChrisHalbert\PhpBCC\Exceptions
 */
class InvalidArgumentException extends \Exception implements ExceptionInterface
{
    /**
     * FileNotFoundException constructor.
     * @param string $message Command failed message.
     */
    public function __construct(string $message = 'Invalid argument passed.')
    {
        return parent::__construct($message, 400);
    }
}
