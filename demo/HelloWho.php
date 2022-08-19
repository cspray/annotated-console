<?php

namespace Cspray\AnnotatedConsoleDemo;

use Cspray\AnnotatedConsole\Attribute\ConsoleCommand;
use Cspray\AnnotatedConsole\Input\Argument;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[ConsoleCommand('hello-who', arguments: [new Argument('who')])]
class HelloWho extends Command {

    protected function execute(InputInterface $input, OutputInterface $output) {
        $who = $input->getArgument('who');
        $output->writeln('Hello, ' . $who . '!');
        return self::SUCCESS;
    }

}