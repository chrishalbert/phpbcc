<?php

namespace ChrisHalbert\PhpBCC\VCS;

use ChrisHalbert\Git\Git;
use ChrisHalbert\PhpBCC\Exceptions\InvalidArrayFormatException;

class GitVCSTest extends \PHPUnit_Framework_TestCase
{
    protected $git;

    protected $gitVCS;

    public function setUp()
    {
        $this->git = $this->getMockBuilder(Git::class)
            ->setMethods(['blameBus'])
            ->getMock();

        $this->gitVCS = new GitVCS([], $this->git);
    }

    public function testGetAuthorAndDate()
    {
        $this->setValidMocks();
        $this->gitVCS->setEntries($this->getEntries());
        $this->assertEquals($this->getExpectedEntriesWithHistory(), $this->gitVCS->getEntries());
    }

    /**
     * @dataProvider dataProviderValidationFails
     */
    public function testValidationFails($entries, $expectedException, $exceptionMessage)
    {
        $this->setExpectedException($expectedException, $exceptionMessage);
        $this->gitVCS->setEntries($entries);
    }

    public function dataProviderValidationFails()
    {
        return [
            [
                [['1pair' => 1, '2pair' => 2, '3pair' => 3]],
                InvalidArrayFormatException::class,
                'Each entry should have only 2 key value pairs.'
            ],
            [
                [['1pair' => 1, '2pair' => 2]],
                InvalidArrayFormatException::class,
                'Each entry must have a `file` and a `line` key.'
            ]
        ];
    }

    protected function setValidMocks()
    {
        $this->git->expects($this->exactly(2))
            ->method('blameBus')
            ->will(
                $this->onConsecutiveCalls(
                    [
                        "a1b2c3d4e5f6",
                        "author John ",
                        "author-mail <>",
                        "author-time 1477980000",
                        "author-tz -0500",
                        "committer John ",
                        "committer-mail <>",
                        "committer-time 1477980000",
                        "committer-tz -0500",
                        "summary Manufacture a test.",
                        "previous f6e5d4c3d2a1",
                        "filename src/Foo.php",
                    ],
                    [
                        "a1b2c3d4e5f6",
                        "author Kelly ",
                        "author-mail <>",
                        "author-time 1478066400",
                        "author-tz -0500",
                        "committer Kelly ",
                        "committer-mail <>",
                        "committer-time 1478066400",
                        "committer-tz -0500",
                        "summary Carve out instructions.",
                        "previous f6e5d4c3d2a1",
                        "filename src/Foo.php",
                    ]
                )
            );
    }

    protected function getExpectedEntriesWithHistory()
    {
        return [
            [
                'author' => 'John', 'date' => '2016-11-01', 'file' => 'Foo.php', 'line' => 1
            ],
            [
                'author' => 'Kelly', 'date' => '2016-11-02', 'file' => 'Bar.php', 'line' => 2
            ]
        ];
    }

    protected function getEntries()
    {
        return [
            [
                'file' => 'Foo.php',
                'line' => 1
            ],
            [
                'file' => 'Bar.php',
                'line' => 2
            ]
        ];
    }
}