<?php

namespace ChrisHalbert\PhpBCC\Output;

class AuthorOutputTest extends \PHPUnit_Framework_TestCase
{
    protected $output;

    public function setUp()
    {
        $this->output = new AuthorOutput();
    }

    public function testOutput()
    {
        $entries = [
            [
            'file' => 'FooFile',
            'line' => 321,
            'author' => 'Jordy',
            'date' => '2016-11-01'
            ]
        ];

        $expected = <<<EOF
PHP BLAME CODE COVERAGE                                                UNCOVERED OBJECTS (#/total) %

Jordy                                                                                     (1/1) 100%
  FooFile:321                                                                             (1/1) 100%

EOF;
        $this->expectOutputString($expected);
        $this->output->output($entries);
    }

    public function testOutputWithLongLine()
    {
        $entries = $this->getLongListOfEntries();
        $expected = <<<EOF
PHP BLAME CODE COVERAGE                                                UNCOVERED OBJECTS (#/total) %

Jordy                                                                                   (50/50) 100%
  FooFile:50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68,   (50/50) 100%
    69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89,
    90, 91, 92, 93, 94, 95, 96, 97, 98, 99

EOF;
        $this->expectOutputString($expected);
        $this->output->output($entries);
    }

    public function getLongListOfEntries()
    {
        $entries = [];

        for ($line = 50; $line < 100; $line++) {
            $entries[] = [
                'file' => 'FooFile',
                'line' => $line,
                'author' => 'Jordy',
                'date' => '2016-11-01'
            ];
        }

        return $entries;
    }
}