<?php

namespace ChrisHalbert\PhpBCC\VCS;

/**
 * Interface VCSInterface
 * @package ChrisHalbert\PhpBCC\VCS
 */
interface VCSInterface
{
    /**
     * VCSInterface constructor.
     * @param array $inputEntries The uncovered object entries provided by the input.
     */
    public function __construct(array $inputEntries);

    /**
     * Returns the entries.
     * @return array
     */
    public function getEntries();

    /**
     * Sets the entries.
     * @param array $entries Uncovered object entries.
     * @return void
     */
    public function setEntries(array $entries);

    /**
     * Get the author and edit date.
     * @param string  $file The file name.
     * @param integer $line The line number in the file.
     * @return array ['author', 'date']
     */
    public function getAuthorAndDate(string $file, int $line);
}
