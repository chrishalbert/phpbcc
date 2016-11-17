<?php

namespace ChrisHalbert\PhpBCC\VCS;

interface VCSInterface
{
    public function __construct(array $inputEntries);

    public function getEntries();
}