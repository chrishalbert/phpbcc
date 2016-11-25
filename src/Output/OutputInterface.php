<?php

namespace ChrisHalbert\PhpBCC\Output;

/**
 * Interface OutputInterface
 * @package ChrisHalbert\PhpBCC\Output
 */
interface OutputInterface
{
    /**
     * Outputs information based on the entries.
     * @param array $entries The entries of the historical data.
     * @return void
     */
    public function output(array $entries);
}
