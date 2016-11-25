<?php

namespace ChrisHalbert\PhpBCC\Output;

class TextOutput implements OutputInterface
{
    const TEMPLATE = "%s:%s %s last touched %s\n";

    public function output(array $entries)
    {
        foreach ($entries as $entry) {
            echo sprintf(self::TEMPLATE, $entry['file'], $entry['line'], $entry['author'], $entry['date']);
        }
    }
}
