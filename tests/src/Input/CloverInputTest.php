<?php

namespace ChrisHalbert\PhpBCC\Input;

use ChrisHalbert\PhpBCC\Exceptions\FileNotFoundException;

class CloverInputTest extends \PHPUnit_Framework_TestCase
{
    private $cloverInput;

    private $cloverXmlPath;

    public function setUp()
    {
        parent::setUp();
        $this->cloverXmlPath = dirname(__FILE__) . '/../../resources/clover-input.xml';
        $this->cloverInput = new CloverInput($this->cloverXmlPath);
    }

    public function testGetEntries()
    {
        $this->assertEquals($this->getExpectedEntries(), $this->cloverInput->getEntries());
    }

    public function testFileNotFoundException()
    {
        $this->setExpectedException(FileNotFoundException::class);
        $noFile = new CloverInput('path/to/no/where.xml');
    }

    public function testGetPath()
    {
        $this->assertEquals($this->cloverXmlPath, $this->cloverInput->getPath());
    }

    protected function getExpectedEntries()
    {
        return [
            [
                'file' => '/home/user/package/subpackage/Foo.php', 'line' => 1
            ],
            [
                'file' => '/home/user/package/subpackage/Foo.php', 'line' => 2
            ],
            [
                'file' => '/home/user/package/subpackage/Foo.php', 'line' => 3
            ],
            [
                'file' => '/home/user/package/subpackage/Bar.php', 'line' => 4
            ],
            [
                'file' => '/home/user/package/subpackage/Bar.php', 'line' => 5
            ],
            [
                'file' => '/home/user/package/subpackage/Bar.php', 'line' => 6
            ],
        ];
    }
}