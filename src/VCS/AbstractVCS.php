<?php

namespace ChrisHalbert\PhpBCC\VCS;

use ChrisHalbert\PhpBCC\Exceptions\InvalidArrayFormatException;

abstract class AbstractVCS implements VCSInterface
{
    private $entries;

    abstract function getAuthorAndDate($file, $line);

    final public function __construct(array $entries = [])
    {
        $this->setEntries($entries);
    }

    final public function setEntries(array $entries)
    {
        $this->validate($entries);
        $this->entries = $entries;
        $this->appendHistory();
    }

    final public function getEntries() {
        return $this->entries;
    }

    final protected function validate($entries)
    {
        foreach ($entries as $entry) {
            if (count($entry) != 2) {
                throw new InvalidArrayFormatException('Each entry should have only 2 key value pairs.');
            }

            if (!isset($entry['file']) || !isset($entry['line'])) {
                throw new InvalidArrayFormatException('Each entry must have a `file` and a `line` key.');
            }
        }
    }

    final protected function appendHistory() {
        foreach ($this->entries as &$entry) {
            list($author, $date) = static::getAuthorAndDate($entry['file'], $entry['line']);
            $entry['author'] = $author;
            $entry['date'] = $date;
        }
    }
}