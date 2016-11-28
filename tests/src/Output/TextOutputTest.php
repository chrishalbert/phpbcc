<?php

namespace ChrisHalbert\PhpBCC\Output;

class TextOutputTest extends \PHPUnit_Framework_TestCase
{
    protected $output;

    public function setUp()
    {
        $this->output = new TextOutput();
    }

    public function testOutput()
    {
        $this->expectOutputString(
            "FooFile:321 Jordy last touched 2016-11-01\nBarFile:123 Nat last touched 2016-11-02\n"
        );
        $this->output->output($this->getEntries());
    }

    protected function getEntries()
    {
        return [
            [
                'file' => 'FooFile',
                'line' => 321,
                'author' => 'Jordy',
                'date' => '2016-11-01'
            ],
            [
                'file' => 'BarFile',
                'line' => 123,
                'author' => 'Nat',
                'date' => '2016-11-02'
            ]
        ];
    }
}
