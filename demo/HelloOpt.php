<?php

namespace Cspray\AnnotatedConsoleDemo;

use Cspray\AnnotatedConsole\Attribute\ConsoleCommand;
use Cspray\AnnotatedConsole\Input\Opt;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[ConsoleCommand('hello-opt', options: [new Opt('who', mode: Opt::Optional, default: 'world')])]
class HelloOpt extends Command {

    protected function execute(InputInterface $input, OutputInterface $output) {
        $who = $input->getOption('who');
        $output->writeln('Hello, ' . $who . '!');
        return self::SUCCESS;
    }

}