<?php

namespace ChrisHalbert\PhpBCC\Input;

/**
 * Interface InputInterface
 * @package ChrisHalbert\PhpBCC\Input
 */
interface InputInterface
{
    /**
     * InputInterface constructor.
     * @param string $path The path to the input file.
     */
    public function __construct(string $path);
}
