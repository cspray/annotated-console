<?php

namespace Cspray\AnnotatedConsole\Unit\Autowire;

use Cspray\AnnotatedConsole\Attribute\ConsoleCommand;
use Cspray\AnnotatedConsole\Autowire\ConsoleCommandAttributeConfigurator;
use Cspray\AnnotatedConsole\Exception\InvalidType;
use Cspray\AnnotatedConsole\Input\Argument;
use Cspray\AnnotatedConsole\Input\Opt;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * @covers \Cspray\AnnotatedConsole\Attribute\ConsoleCommand
 * @covers \Cspray\AnnotatedConsole\Autowire\ConsoleCommandAttributeConfigurator
 * @covers \Cspray\AnnotatedConsole\Exception\Exception
 * @covers \Cspray\AnnotatedConsole\Exception\InvalidType
 * @covers \Cspray\AnnotatedConsole\Input\Argument
 * @covers \Cspray\AnnotatedConsole\Input\Opt
 */
final class ConsoleCommandAttributeConfiguratorTest extends TestCase {

    public function testConfigureName() : void {
        $command = new Command();
        $consoleCommand = new ConsoleCommand('my-cmd-name');

        (new ConsoleCommandAttributeConfigurator())->configure($command, $consoleCommand);

        self::assertSame('my-cmd-name', $command->getName());
    }

    public function testConfigureDescription() : void {
        $command = new Command();
        $consoleCommand = new ConsoleCommand('my-cmd-name', 'My Description');

        (new ConsoleCommandAttributeConfigurator())->configure($command, $consoleCommand);

        self::assertSame('My Description', $command->getDescription());
    }

    public function testConfigurationInputArguments() : void {
        $command = new Command();
        $consoleCommand = new ConsoleCommand(
            'cmd-name',
            arguments: [$a = new Argument('my-arg'), $b = new Argument('b')]
        );

        (new ConsoleCommandAttributeConfigurator())->configure($command, $consoleCommand);

        self::assertSame(['my-arg' => $a->asInputArgument(), 'b' => $b->asInputArgument()], $command->getDefinition()->getArguments());
    }

    public function testConfigurationInputArgumentNotCorrectTypeThrowsException() : void {
        $command = new Command();
        $consoleCommand = new ConsoleCommand('bad-arg', arguments: [new InputArgument('a')]);

        $this->expectException(InvalidType::class);
        $this->expectExceptionMessage('The type passed in a list of ConsoleCommand arguments MUST be ' . Argument::class . ' but ' . InputArgument::class . ' was given.');
        (new ConsoleCommandAttributeConfigurator())->configure($command, $consoleCommand);
    }

    public function testConfigurationInputOptions() : void {
        $command = new Command();
        $consoleCommand = new ConsoleCommand(
            'cmd-name',
            options: [$a = new Opt('a'), $b = new Opt('b')]
        );

        (new ConsoleCommandAttributeConfigurator())->configure($command, $consoleCommand);

        self::assertSame(['a' => $a->asInputOption(), 'b' => $b->asInputOption()], $command->getDefinition()->getOptions());
    }

    public function testConfigurationInputOptionNotCorrectTypeThrowsException() : void {
        $command = new Command();
        $consoleCommand = new ConsoleCommand('bad-arg', options: [$this]);

        $this->expectException(InvalidType::class);
        $this->expectExceptionMessage('The type passed in a list of ConsoleCommand options MUST be ' . InputOption::class . ' but ' . $this::class . ' was given.');
        (new ConsoleCommandAttributeConfigurator())->configure($command, $consoleCommand);
    }
}