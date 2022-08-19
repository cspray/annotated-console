<?php

namespace Cspray\AnnotatedConsole\Input;

use Symfony\Component\Console\Input\InputArgument;

final class Argument {

    public const Required = InputArgument::REQUIRED;
    public const Optional = InputArgument::OPTIONAL;
    public const IsArray = InputArgument::IS_ARRAY;

    private ?InputArgument $argument = null;

    public function __construct(
        public readonly string $name,
        public readonly string $description = '',
        public readonly ?int $mode = null,
        public readonly string|int|float|bool|array|null $default = null
    ) {

    }

    public function asInputArgument() : InputArgument {
        if ($this->argument === null) {
            $argument = new InputArgument($this->name, $this->mode, $this->description);
            if (!$argument->isRequired()) {
                $argument->setDefault($this->default);
            }
            $this->argument = $argument;
        }

        return $this->argument;
    }

}