<?php

namespace ChrisHalbert\PhpBCC\Output;

/**
 * Class TextOutput
 * @package ChrisHalbert\PhpBCC\Output
 */
class TextOutput implements OutputInterface
{
    /**
     * The template for output.
     * @const string
     */
    const TEMPLATE = "%s:%s %s last touched %s\n";

    /**
     * Outputs text results.
     * @param array $entries Entries array with each element having file, line, author, and date.
     * @return void
     */
    public function output(array $entries)
    {
        foreach ($entries as $entry) {
            echo sprintf(self::TEMPLATE, $entry['file'], $entry['line'], $entry['author'], $entry['date']);
        }
    }
}
