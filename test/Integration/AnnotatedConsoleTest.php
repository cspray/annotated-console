<?php

namespace Cspray\AnnotatedConsole\Integration;

use Cspray\AnnotatedConsole\AnnotatedConsole;
use Cspray\AnnotatedConsole\Stub\StubOutput;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;

/**
 * @covers \Cspray\AnnotatedConsole\AnnotatedConsole
 * @covers \Cspray\AnnotatedConsole\Attribute\ConsoleCommand
 * @covers \Cspray\AnnotatedConsole\Autowire\ConsoleCommandAttributeConfigurator
 * @covers \Cspray\AnnotatedConsole\Autowire\ApplicationCommandProvider
 * @covers \Cspray\AnnotatedConsole\Input\Argument
 * @covers \Cspray\AnnotatedConsole\Input\Opt
 */
class AnnotatedConsoleTest extends TestCase {

    public function testCommandAutoConfiguredAndAddedToApplication() : void {
        $output = new StubOutput();
        $subject = new AnnotatedConsole(['default', 'dev']);

        $subject->run(new ArrayInput(['hello-world']), $output);

        self::assertSame(['Hello, world!' . PHP_EOL], $output->getLines());
    }

    public function testRunnerRespectsPassedApplication() : void {
        $output = new StubOutput();
        $app = new Application('my-test-app');
        $subject = new AnnotatedConsole(['default', 'dev'], application: $app);

        $subject->run(new ArrayInput(['hello-app-name']), $output);

        self::assertSame(['Hello, my-test-app!' . PHP_EOL], $output->getLines());
    }

    public function testRunnerRespectsDevProfiles() : void {
        $output = new StubOutput();
        $subject = new AnnotatedConsole(profiles: ['default', 'dev']);

        $subject->run(new ArrayInput(['hello-service']), $output);

        self::assertSame(['Hello, dev!' . PHP_EOL], $output->getLines());
    }

    public function testRunnerRespectsProdProfiles() : void {
        $output = new StubOutput();
        $subject = new AnnotatedConsole(profiles: ['default', 'prod']);

        $subject->run(new ArrayInput(['hello-service']), $output);

        self::assertSame(['Hello, prod!' . PHP_EOL], $output->getLines());
    }


}