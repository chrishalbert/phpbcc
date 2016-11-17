<?php

namespace ChrisHalbert\PhpBCC\Console;

use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Application extends ConsoleApplication
{
    /**
     * Shorthand name of the application.
     * @const string
     */
    const NAME = 'phpbcc';

    /**
     * Version of the application.
     * @const string
     */
    const VERSION = '0.0.1';

    /**
     * Get the name of the command.
     * @param InputInterface $input The input interface.
     * @return string
     */
    protected function getCommandName(InputInterface $input)
    {
        return Application::NAME;
    }

    public function __construct()
    {
        parent::__construct(Application::NAME, Application::VERSION);
    }

    /**
     * Gets the default commands that shoudl be available.
     * @return array|\Symfony\Component\Console\Command\Command[]
     */
    protected function getDefaultCommands()
    {
        $defaultCommands = parent::getDefaultCommands();
        $defaultCommands[] = new Command();
        return $defaultCommands;
    }

    /**
     * Clear out the application.
     * @return \Symfony\Component\Console\Input\InputDefinition
     */
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        $inputDefinition->setArguments();
        return $inputDefinition;
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $output->write(
            sprintf(
                "%s version %s by Chris Halbert" . PHP_EOL . PHP_EOL,
                $this->getName(),
                $this->getVersion()
            )
        );
        parent::doRun($input, $output);
    }
}