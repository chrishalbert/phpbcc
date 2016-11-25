<?php

namespace ChrisHalbert\PhpBCC\VCS;

use ChrisHalbert\Git\Git;

class GitVCS extends AbstractVCS
{
    const AUTHOR = "author ";
    const DATE = "author-time ";

    public function getAuthorAndDate($file, $line)
    {
        $git = new Git();
        $author = '';
        $date = '';

        $porcelain = $git->blameBus($file, $line);
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

    private function stripEntity($key, $string)
    {
        return trim(str_replace($key, '', $string));
    }
}