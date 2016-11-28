<?php

namespace ChrisHalbert\PhpBCC\Console;

class CommandTest extends \PHPUnit_Framework_TestCase
{
    protected $command;

    public function setUp()
    {
        $this->command = new Command();
    }
}
