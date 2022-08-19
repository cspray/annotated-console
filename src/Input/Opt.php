<?php

namespace Cspray\AnnotatedConsole\Input;

use Symfony\Component\Console\Input\InputOption;

final class Opt {

    public const None = InputOption::VALUE_NONE;
    public const Required = InputOption::VALUE_REQUIRED;
    public const Optional = InputOption::VALUE_OPTIONAL;
    public const IsArray = InputOption::VALUE_IS_ARRAY;
    public const Negatable = InputOption::VALUE_NEGATABLE;

    private ?InputOption $opt = null;

    public function __construct(
        private readonly string $name,
        private readonly ?string $shortName = null,
        private readonly string $description = '',
        private readonly int $mode = self::None,
        private readonly string|int|float|bool|array|null $default = null
    ) {}

    public function asInputOption() : InputOption {
        if ($this->opt === null) {
            $this->opt = new InputOption(
                $this->name,
                $this->shortName,
                $this->mode,
                $this->description,
            );

            if ($this->opt->isValueRequired() || $this->opt->isValueOptional()) {
                $this->opt->setDefault($this->default);
            }

        }
        return $this->opt;
    }

}