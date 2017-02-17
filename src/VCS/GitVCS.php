<?php

namespace ChrisHalbert\PhpBCC\VCS;

use ChrisHalbert\Git\Git;

/**
 * Class GitVCS
 * @package ChrisHalbert\PhpBCC\VCS
 */
class GitVCS extends AbstractVCS
{
    /**
     * The Git author slug.
     * @const string
     */
    const AUTHOR = "author ";

    /**
     * The Git author time slug.
     * @const string
     */
    const DATE = "author-time ";

    /**
     * The vcs.
     * @var Git
     */
    protected $git;

    /**
     * GitVCS constructor.
     * @param array    $entries The entries.
     * @param Git|null $vcs     The vcs.
     */
    public function __construct(array $entries = [], $vcs = null)
    {
        $this->git = $vcs ?: new Git();
        parent::__construct($entries);
    }

    /**
     * Get the author and edit date.
     * @param string  $file The file name.
     * @param integer $line The line number in the file.
     * @return array ['author', 'date']
     */
    public function getAuthorAndDate(string $file, int $line)
    {
        $author = '';
        $date = '';

        $porcelain = $this->git->blameBus($file, $line);
        foreach ($porcelain as $shard) {
            if (strpos($shard, self::AUTHOR) === 0) {
                $author = $this->stripEntity(self::AUTHOR, $shard);
            }

            if (strpos($shard, self::DATE) === 0) {
                $date = date("Y-m-d", $this->stripEntity(self::DATE, $shard));
            }
        }

        return [$author, $date];
    }

    /**
     * Strips out the key and trims the remaining string.
     * @param string $key    Key should be removed.
     * @param string $string The string is what the key is removed from.
     * @return string
     */
    private function stripEntity(string $key, string $string)
    {
        return trim(str_replace($key, '', $string));
    }
}
