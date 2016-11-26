<?php

namespace ChrisHalbert\PhpBCC\Input;

use ChrisHalbert\PhpBCC\Exceptions\FileNotFoundException;

/**
 * Class AbstractInput
 * @package ChrisHalbert\PhpBCC\Input
 */
abstract class AbstractInput implements InputInterface
{
    /**
     * Path to the input file.
     * @var string
     */
    private $path;

    /**
     * Contents of the file.
     * @var string
     */
    private $contents;

    /**
     * Uncovered object entries.
     * @var array
     */
    private $entries;

    /**
     * AbstractInput constructor.
     * @param string $path Path to the input.
     * @throws FileNotFoundException If file path does not exist.
     */
    final public function __construct($path)
    {
        if (!file_exists($path)) {
            throw new FileNotFoundException("File `$path` not found.");
        }

        $this->path = $path;
        $this->contents = file_get_contents($path);
        $this->entries = [];
        static::loadExposedObjects();
    }

    /**
     * Loads the exposed/uncovered objects into the entries.
     * @return void
     */
    abstract protected function loadExposedObjects();

    /**
     * Returns the path.
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns the inputs contents.
     * @return string
     */
    public function getInputContents()
    {
        return $this->contents;
    }

    /**
     * Returns the loaded entries.
     * @return array
     */
    final public function getEntries()
    {
        return $this->entries;
    }

    /**
     * Adds an entry to the array of issues.
     * @param string  $fileName   The file name of an uncovered object.
     * @param integer $lineNumber The line number of an uncovered object.
     * @return void
     */
    final public function addEntry($fileName, $lineNumber)
    {
        $this->entries[] = ['file' => $fileName, 'line' => $lineNumber];
    }
}
