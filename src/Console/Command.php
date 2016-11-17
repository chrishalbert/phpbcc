<?php

namespace ChrisHalbert\PhpBCC\Console;

use ChrisHalbert\PhpBCC\Exceptions\InvalidArgument;
use ChrisHalbert\PhpBCC\Exceptions\InvalidArgumentException;
use ChrisHalbert\PhpBCC\Input\CloverInput;
use ChrisHalbert\PhpBCC\Input\DefaultInput;
use ChrisHalbert\PhpBCC\VCS\GitVCS;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
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
        $inputFormat = $this->loadInputFormat($input);
        $vcsType = $this->loadVCSType($input);

        $exposedObjects = $inputFormat->getEntries();
        $vcsType->setEntries($exposedObjects);
        $historicalEntries = $vcsType->getEntries();

        var_dump($historicalEntries);
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
}