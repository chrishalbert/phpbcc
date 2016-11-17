<?php

namespace ChrisHalbert\PhpBCC\VCS;

use ChrisHalbert\Git\Git;

class GitVCS extends AbstractVCS
{
    public function getAuthorAndDate($file, $line)
    {
        $git = new Git();

        var_dump($git->blameBus($file, $line));
    }
}