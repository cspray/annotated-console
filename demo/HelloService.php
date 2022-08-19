<?php

namespace Cspray\AnnotatedConsoleDemo;

use Cspray\AnnotatedConsole\Attribute\ConsoleCommand;
use Cspray\AnnotatedConsoleDemo\Services\Provider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[ConsoleCommand('hello-service')]
class HelloService extends Command {

    public function __construct(
        private readonly Provider $provider
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('Hello, ' . $this->provider->get() . '!');
        return self::SUCCESS;
    }

}