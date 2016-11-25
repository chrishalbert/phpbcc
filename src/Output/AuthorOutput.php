<?php

namespace ChrisHalbert\PhpBCC\Output;

class AuthorOutput implements OutputInterface
{
    const CHARS_PER_LINE = 100;

    const RIGHT_PADDING = 14;

    private $entries;

    private $totalLines = 0;

    private $linesByAuthor = [];

    protected $authorOutput = [];

    public function output(array $entries)
    {
        $this->entries = $entries;
        $this->prepareBreakdown();
        $this->outputResults();
    }

    protected function prepareBreakdown()
    {
        foreach ($this->entries as $entry) {
            $author = $entry['author'];
            $file = basename($entry['file']);
            $line = $entry['line'];

            // Initialize the author if not set
            if (!isset($this->authorOutput[$author])) {
                $this->authorOutput[$author] = [];
                $this->linesByAuthor[$author] = 0;
            }

            // Initialize the file if not set
            if (!isset($this->authorOutput[$author][$file])) {
                $this->authorOutput[$author][$file] = [];
            }

            // Initialize the array of lines if not set
            if (!isset($this->authorOutput[$author][$file]['lines'])) {
                $this->authorOutput[$author][$file]['lines'] = [];
            }

            $this->authorOutput[$author][$file]['lines'][] = $line;
            $this->addAuthorEntry($author);
        }
    }

    protected function addAuthorEntry($author)
    {
        $this->linesByAuthor[$author]++;
        $this->totalLines++;
    }

    protected function outputResults()
    {
        echo $this->rightAlign('PHP BLAME CODE COVERAGE', 'UNCOVERED OBJECTS (#/total) %') . PHP_EOL . PHP_EOL;

        foreach ($this->authorOutput as $author => $files) {
            echo $this->getAuthorHeader($author);
            foreach ($files as $fileName => $file) {
                $fileOutput = "  " . $fileName . ":" . implode(', ', $file['lines']);
                $stats = $this->getStats(count($file['lines']), $this->totalLines);
                echo $this->wrapLineWithRightAlign($fileOutput, $stats);
                echo PHP_EOL;
            }
        }
    }

    protected function getAuthorHeader($author)
    {
        $stats = $this->getStats($this->linesByAuthor[$author], $this->totalLines);
        return $this->rightAlign($author, $stats) . PHP_EOL;
    }

    protected function getStats($count, $total)
    {
        $percent = strval(round($count / $total * 100, 1)) . '%';
        $ration = '(' . $count . '/' . $total . ')';
        return $ration . ' ' . $percent;
    }

    protected function wrapLineWithRightAlign($subject, $word)
    {
        $len = strlen($word);

        if (strlen($subject) < self::CHARS_PER_LINE - $len + 1) {
            return $this->rightAlign($subject, $word);
        }

        $newSubject = substr_replace($subject, "\n", self::CHARS_PER_LINE - $len, 0);
        return $this->wrapLine($newSubject);
    }

    protected function wrapLine($line)
    {
        return wordwrap($line, self::CHARS_PER_LINE - self::RIGHT_PADDING, "\n    ");
    }

    protected function rightAlign($line, $word)
    {
        $len = strlen($word);
        return str_pad($line, self::CHARS_PER_LINE - $len) . $word;
    }
}