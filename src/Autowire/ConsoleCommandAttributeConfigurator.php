<?php

namespace Cspray\AnnotatedConsole\Autowire;

use Cspray\AnnotatedConsole\Attribute\ConsoleCommand;
use Cspray\AnnotatedConsole\Exception\InvalidType;
use Cspray\AnnotatedConsole\Input\Argument;
use Cspray\AnnotatedConsole\Input\Opt;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

final class ConsoleCommandAttributeConfigurator {

    public function configure(Command $command, ConsoleCommand $consoleCommand) : void {
        // Remember that the ConsoleCommand is a ServiceAttribute. The getName function returns to the _service_ name
        $command->setName($consoleCommand->getCommandName());
        $command->setDescription($consoleCommand->getDescription());

        foreach ($consoleCommand->getArguments() as $argument) {
            if (!$argument instanceof Argument) {
                $provided = is_object($argument) ? $argument::class : gettype($argument);
                throw InvalidType::fromInvalidInputArgument($provided);
            }
            $command->getDefinition()->addArgument($argument->asInputArgument());
        }

        foreach ($consoleCommand->getOptions() as $option) {
            if (!$option instanceof Opt) {
                $provided = is_object($option) ? $option::class : gettype($option);
                throw InvalidType::fromInvalidInputOption($provided);
            }
            $command->getDefinition()->addOption($option->asInputOption());
        }

    }

}