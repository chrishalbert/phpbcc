<?php

namespace ChrisHalbert\PhpBCC\Input;

use ChrisHalbert\PhpBCC\Exceptions\FileNotFoundException;

abstract class AbstractInput implements InputInterface
{
    private $path;

    private $contents;

    private $entries;

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

    abstract protected function loadExposedObjects();

    public function getPath()
    {
        return $this->path;
    }

    public function getInputContents()
    {
        return $this->contents;
    }

    final public function getEntries()
    {
        return $this->entries;
    }

    final public function addEntry($fileName, $lineNumber)
    {
        $this->entries[] = ['file' => $fileName, 'line' => $lineNumber];
    }
}