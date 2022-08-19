<?php

namespace Cspray\AnnotatedConsole\Exception;

use Cspray\AnnotatedConsole\Input\Argument;
use Symfony\Component\Console\Input\InputOption;

final class InvalidType extends Exception {

    public static function fromInvalidInputArgument(string $provided) : self {
        return new self(sprintf(
            'The type passed in a list of ConsoleCommand arguments MUST be %s but %s was given.',
            Argument::class,
            $provided
        ));
    }

    public static function fromInvalidInputOption(string $provided) : self {
        return new self(sprintf(
            'The type passed in a list of ConsoleCommand options MUST be %s but %s was given.',
            InputOption::class,
            $provided
        ));
    }

}