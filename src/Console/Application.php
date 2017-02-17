<?php

namespace ChrisHalbert\PhpBCC\Console;

use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Application
 * @package ChrisHalbert\PhpBCC\Console
 */
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
    const VERSION = '1.0.0';

    /**
     * Get the name of the command.
     * @param InputInterface $input The input interface.
     * @return string
     */
    protected function getCommandName(InputInterface $input)
    {
        return Application::NAME;
    }

    /**
     * Application constructor.
     */
    public function __construct()
    {
        parent::__construct(Application::NAME, Application::VERSION);
    }

    /**
     * Gets the default commands that should be available.
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

    /**
     * Runs the application.
     * @param InputInterface  $input  The input to the command.
     * @param OutputInterface $output The output to the command.
     * @return void
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $output->write(
            sprintf(
                "%s version %s by Chris Halbert" . PHP_EOL . PHP_EOL,
                $this->getName(),
                $this->getVersion()
            )
        );

        $this->parentDoRun($input, $output);
    }

    /**
     * Calls the parent method.
     * @param InputInterface  $input  The input to the command.
     * @param OutputInterface $output The output to the command.
     * @return void
     * @codeCoverageIgnore
     */
    protected function parentDoRun(InputInterface $input, OutputInterface $output)
    {
        parent::doRun($input, $output);
    }
}
