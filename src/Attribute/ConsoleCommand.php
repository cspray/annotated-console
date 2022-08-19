<?php

namespace Cspray\AnnotatedConsole\Attribute;

use Cspray\AnnotatedConsole\Input\Argument;
use Cspray\AnnotatedConsole\Input\Opt;
use Cspray\AnnotatedContainer\Attribute\ServiceAttribute;
use Symfony\Component\Console\Input\InputOption;

#[\Attribute(\Attribute::TARGET_CLASS)]
final class ConsoleCommand implements ServiceAttribute {

    /**
     * @param string $commandName
     * @param string $description
     * @param list<Argument> $arguments
     * @param list<Opt> $options
     */
    public function __construct(
        private readonly string $commandName,
        private readonly string $description = '',
        private readonly array $arguments = [],
        private readonly array $options = []
    ) {}

    public function getCommandName() : string {
        return $this->commandName;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function getArguments() : array {
        return $this->arguments;
    }

    public function getOptions() : array {
        return $this->options;
    }

    public function getProfiles() : array {
        return [];
    }

    public function isPrimary() : bool {
        return false;
    }

    public function getName() : ?string {
        return null;
    }
}