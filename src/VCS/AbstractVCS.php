<?php

namespace ChrisHalbert\PhpBCC\VCS;

use ChrisHalbert\PhpBCC\Exceptions\InvalidArrayFormatException;

/**
 * Class AbstractVCS
 * @package ChrisHalbert\PhpBCC\VCS
 */
abstract class AbstractVCS implements VCSInterface
{
    /**
     * Entries of vcs
     * @var array
     */
    private $entries;

    /**
     * Get the author and edit date.
     * @param string  $file The file name.
     * @param integer $line The line number in the file.
     * @return array ['author', 'date']
     */
    abstract public function getAuthorAndDate($file, $line);

    /**
     * VCSInterface constructor.
     * @param array $entries The uncovered object entries provided by the input.
     */
    final public function __construct(array $entries = [])
    {
        $this->setEntries($entries);
    }

    /**
     * Sets the entries.
     * @param array $entries Uncovered object entries.
     * @return void
     */
    final public function setEntries(array $entries)
    {
        $this->validate($entries);
        $this->entries = $entries;
        $this->appendHistory();
    }

    /**
     * Returns the entries.
     * @return array
     */
    final public function getEntries()
    {
        return $this->entries;
    }


    /**
     * Validates the entry format.
     * @param array $entries The uncovered object entries.
     * @return void
     * @throws InvalidArrayFormatException If format is not as expected.
     */
    final protected function validate(array $entries)
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

    /**
     * Append the history.
     * @return void
     */
    final protected function appendHistory()
    {
        foreach ($this->entries as &$entry) {
            list($author, $date) = static::getAuthorAndDate($entry['file'], $entry['line']);
            $entry['author'] = $author;
            $entry['date'] = $date;
        }
    }
}
