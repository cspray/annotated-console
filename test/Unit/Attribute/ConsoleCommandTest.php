<?php

namespace Cspray\AnnotatedConsole\Unit\Attribute;

use Cspray\AnnotatedConsole\Attribute\ConsoleCommand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Cspray\AnnotatedConsole\Attribute\ConsoleCommand
 */
class ConsoleCommandTest extends TestCase {

    public function testConsoleCommandProfilesEmpty() : void {
        $consoleCommand = new ConsoleCommand('command-name');

        self::assertEmpty($consoleCommand->getProfiles());
    }

    public function testConsoleCommandIsNotPrimary() : void {
        $consoleCommand = new ConsoleCommand('command-name');

        self::assertFalse($consoleCommand->isPrimary());
    }

    public function testConsoleCommandGetName() : void {
        $consoleCommand = new ConsoleCommand('command-name');

        self::assertNull($consoleCommand->getName());
    }

}