<?php

namespace Cspray\AnnotatedConsole\Acceptance;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Cspray\AnnotatedConsole\AnnotatedConsole
 * @covers \Cspray\AnnotatedConsole\Autowire\ConsoleCommandAttributeConfigurator
 * @covers \Cspray\AnnotatedConsole\Attribute\ConsoleCommand
 * @covers \Cspray\AnnotatedConsole\Autowire\ApplicationCommandProvider
 */
class ExecAppTest extends TestCase {

    public function testHasHelloWorldOutput() : void {
        $command = dirname(__DIR__, 2) . '/demo/app hello-world';
        exec($command, $output);

        self::assertSame(['Hello, world!'], $output);
    }

    public function testHelloWorldExitCode() : void {
        $command = dirname(__DIR__, 2) . '/demo/app hello-world';
        exec($command, $output, $exitCode);

        self::assertSame(0, $exitCode);
    }

    public function testErrorCodeHasCorrectExitCode() : void {
        $command = dirname(__DIR__, 2) . '/demo/app return-error-code';
        exec($command, $output, $exitCode);

        self::assertSame(1, $exitCode);
    }

    public function testExecuteHelloWho() : void {
        $command = dirname(__DIR__, 2) . '/demo/app hello-who "Annotated Container"';
        exec($command, $output);

        self::assertSame(['Hello, Annotated Container!'], $output);
    }

    public function testExecuteHelloOptDefault() : void {
        $command = dirname(__DIR__, 2) . '/demo/app hello-opt';
        exec($command, $output);

        self::assertSame(['Hello, world!'], $output);
    }

    public function testExecuteHelloOptWithValue() : void {
        $command = dirname(__DIR__, 2) . '/demo/app hello-opt --who=cspray';
        exec($command, $output);

        self::assertSame(['Hello, cspray!'], $output);
    }

}