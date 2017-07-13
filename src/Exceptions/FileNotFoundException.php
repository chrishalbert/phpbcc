<?php

namespace ChrisHalbert\PhpBCC\Exceptions;

/**
 * Class FileNotFoundException
 * @package ChrisHalbert\PhpBCC\Exceptions
 */
class FileNotFoundException extends \Exception implements ExceptionInterface
{
    /**
     * FileNotFoundException constructor.
     * @param string $message Command failed message.
     */
    public function __construct(string $message = 'File not found.')
    {
        return parent::__construct($message, 400);
    }
}
