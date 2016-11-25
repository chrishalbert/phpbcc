<?php

namespace ChrisHalbert\PhpBCC\Input;

class CloverInput extends AbstractInput
{
    protected function loadExposedObjects()
    {
        $coverageXml = new \SimpleXMLElement($this->getInputContents());
        $files = $coverageXml->xpath("//file");
        $this->seekFileStats($files);
    }

    private function seekFileStats($files)
    {
        foreach ($files as $file) {
            $this->seekLineStats($file);
        }
    }

    private function seekLineStats($file)
    {
        foreach ($file->children()->line as $line) {
            $lineNumber = (int) $line['num']->__toString();
            $this->addEntry($file['name']->__toString(), $lineNumber);
        }
    }
}