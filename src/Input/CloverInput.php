<?php

namespace ChrisHalbert\PhpBCC\Input;

/**
 * Class CloverInput
 * @package ChrisHalbert\PhpBCC\Input
 */
class CloverInput extends AbstractInput
{
    /**
     * Loads the exposed objects.
     * @return void
     */
    protected function loadExposedObjects()
    {
        $coverageXml = new \SimpleXMLElement($this->getInputContents());
        $files = $coverageXml->xpath("//file");
        $this->seekFileStats($files);
    }

    /**
     * Grabs files to iterate lines.
     * @param \SimpleXMLElement[] $files The files of the clover input.
     * @return void
     */
    private function seekFileStats(array $files)
    {
        foreach ($files as $file) {
            $this->seekLineStats($file);
        }
    }

    /**
     * Grabs line stats.
     * @param \SimpleXMLElement $file The file.
     * @return void
     */
    private function seekLineStats(\SimpleXMLElement $file)
    {
        foreach ($file->children()->line as $line) {
            if (!$line['count']) {
                continue;
            }
            $lineNumber = (int) $line['num']->__toString();
            $this->addEntry($file['name']->__toString(), $lineNumber);
        }
    }
}
