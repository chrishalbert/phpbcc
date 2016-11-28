<?php

namespace ChrisHalbert\PhpBCC\Output;

/**
 * Class AuthorOutput
 * @package ChrisHalbert\PhpBCC\Output
 */
class AuthorOutput implements OutputInterface
{
    /**
     * Number of characters per line.
     * @const integer
     */
    const CHARS_PER_LINE = 100;

    /**
     * Right padding spaces.
     * @const integer
     */
    const RIGHT_PADDING = 14;

    /**
     * The entries.
     * @var array
     */
    private $entries;

    /**
     * Total lines of uncovered code.
     * @var integer
     */
    private $totalLines = 0;

    /**
     * Associative array of $author => $lines.
     * @var array
     */
    private $linesByAuthor = [];

    /**
     * The output for the author.
     * @var array
     */
    protected $authorOutput = [];

    /**
     * Outputs information based on the entries.
     * @param array $entries The uncovered code entries.
     * @return void
     */
    public function output(array $entries)
    {
        $this->entries = $entries;
        $this->prepareBreakdown();
        $this->outputResults();
    }

    /**
     * Prepares the breakdown of data.
     * @return void
     */
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

    /**
     * Adds an entry for an author and to the total lines.
     * @param string $author The author.
     * @return void
     */
    protected function addAuthorEntry($author)
    {
        $this->linesByAuthor[$author]++;
        $this->totalLines++;
    }

    /**
     * Outputs the results formatting for a terminal screen of 100.
     * @return void
     */
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

    /**
     * Gets the header for the author section.
     * @param string $author The author.
     * @return string
     */
    protected function getAuthorHeader($author)
    {
        $stats = $this->getStats($this->linesByAuthor[$author], $this->totalLines);
        return $this->rightAlign($author, $stats) . PHP_EOL;
    }

    /**
     * Gets stats in a readable format based on the count and total
     * @param integer $count The count.
     * @param integer $total The total.
     * @return string
     */
    protected function getStats($count, $total)
    {
        $percent = strval(round($count / $total * 100, 1)) . '%';
        $ration = '(' . $count . '/' . $total . ')';
        return $ration . ' ' . $percent;
    }

    /**
     * Wraps line and right aligns the word for the first line.
     * @param string $subject The main string.
     * @param string $word    The word to append.
     * @return string
     */
    protected function wrapLineWithRightAlign($subject, $word)
    {
        $lineOutput = '';
        $len = strlen($word);

        if (strlen($subject) < self::CHARS_PER_LINE - $len + 1) {
            return $this->rightAlign($subject, $word);
        }

        $lines = explode("\n", $this->wrapLine($subject));
        $firstLine = array_shift($lines);

        // Add the stats to the first line.
        $lineOutput .= $this->rightAlign($firstLine, $word) . "\n    ";

        // And add the remaining lines to the resulting string.
        $lineOutput .= $this->wrapLine(implode(" ", array_map("trim", $lines)));

        return $lineOutput;
    }

    /**
     * Wraps lines based on the specified characters and padding.
     * @param string $line A string.
     * @return string
     */
    protected function wrapLine($line)
    {
        return wordwrap($line, self::CHARS_PER_LINE - self::RIGHT_PADDING, "\n    ");
    }

    /**
     * Right aligns a word into a given string.
     * @param string $line The line to add to.
     * @param string $word The word to be added.
     * @return string
     */
    protected function rightAlign($line, $word)
    {
        $len = strlen($word);
        return str_pad($line, self::CHARS_PER_LINE - $len) . $word;
    }
}
