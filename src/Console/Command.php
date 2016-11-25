<?php

namespace ChrisHalbert\PhpBCC\Console;

use ChrisHalbert\PhpBCC\Exceptions\InvalidArgument;
use ChrisHalbert\PhpBCC\Exceptions\InvalidArgumentException;
use ChrisHalbert\PhpBCC\Input\CloverInput;
use ChrisHalbert\PhpBCC\Input\DefaultInput;
use ChrisHalbert\PhpBCC\Output\AuthorOutput;
use ChrisHalbert\PhpBCC\Output\TextOutput;
use ChrisHalbert\PhpBCC\VCS\GitVCS;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends SymfonyCommand
{
    protected static $options = [
        [
            'vcs', null, InputOption::VALUE_OPTIONAL, 'The version control system.', 'git'
        ],
        [
            'input-format', null, InputOption::VALUE_OPTIONAL, 'The code coverage report format.', 'clover'
        ],
        [
            'output-format', null, InputOption::VALUE_OPTIONAL, 'The report format.', 'text'
        ]
    ];


    protected function configure()
    {
        $this->setName(Application::NAME)
            ->setDefinition([
                    new InputArgument(
                        'path',
                        InputArgument::REQUIRED
                    )
                ]
            );

        foreach (self::$options as $option) {
            call_user_func_array([$this, "addOption"], $option);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Load the different types.
        $inputFormat = $this->loadInputFormat($input);
        $vcsType = $this->loadVCSType($input);
        $outputFormatter = $this->loadOutputFormat($input);

        // Get the code coverage violation entries from the input type
        $exposedObjects = $inputFormat->getEntries();

        // Set the VCS with the entries and get an array with historical data
        $vcsType->setEntries($exposedObjects);
        $historicalEntries = $vcsType->getEntries();

        // Output the results
        $outputFormatter->output($historicalEntries);
    }

    /**
     * @param InputInterface $input
     * @return
     */
    protected function loadInputFormat(InputInterface $input)
    {
        $path = $input->getArgument('path');
        switch ($input->getOption('input-format')) {
            case 'clover':
                return new CloverInput($path);
                break;
            default:
                break;
        }
        throw new InvalidArgumentException('A valid `input-format` argument was not passed.');
    }

    protected function loadVCSType(InputInterface $input)
    {
        switch ($input->getOption('vcs')) {
            case 'git':
                return new GitVCS();
            default:
                break;
        }
        throw new InvalidArgumentException('A valid `vcs` argument was not passed.');
    }

    protected function loadOutputFormat(InputInterface $input)
    {
        switch ($input->getOption('output-format')) {
            case 'text':
                return new TextOutput();
            case 'author':
                return new AuthorOutput()   ;
            default:
                break;
        }
    }
}