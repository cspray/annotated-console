<?php

namespace Cspray\AnnotatedConsole\Stub;

use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\OutputInterface;

class StubOutput extends Output implements OutputInterface {

    private array $lines = [];

    protected function doWrite(string $message, bool $newline) {
        if ($newline) {
            $message .= PHP_EOL;
        }
        $this->lines[] = $message;
    }

    public function getLines() : array {
        return $this->lines;
    }

}