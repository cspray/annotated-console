<?php

namespace Cspray\AnnotatedConsoleDemo;

use Cspray\AnnotatedConsole\Attribute\ConsoleCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[ConsoleCommand('return-error-code')]
class ReturnErrorCode extends Command {

    protected function execute(InputInterface $input, OutputInterface $output) {
        return self::FAILURE;
    }

}