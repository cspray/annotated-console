<?php

namespace Cspray\AnnotatedConsoleDemo;

use Cspray\AnnotatedConsole\Attribute\ConsoleCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[ConsoleCommand('hello-app-name')]
class HelloAppName extends Command {

    protected function execute(InputInterface $input, OutputInterface $output) {
        $appName = $this->getApplication()->getName();
        $output->writeln('Hello, ' . $appName . '!');
        return self::SUCCESS;
    }

}