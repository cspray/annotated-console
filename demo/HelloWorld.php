<?php

namespace Cspray\AnnotatedConsoleDemo;

use Cspray\AnnotatedConsole\Attribute\ConsoleCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[ConsoleCommand('hello-world')]
class HelloWorld extends Command {

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('Hello, world!');
        return self::SUCCESS;
    }


}