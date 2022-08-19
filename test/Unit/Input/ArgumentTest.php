<?php

namespace Cspray\AnnotatedConsole\Unit\Input;

use Cspray\AnnotatedConsole\Input\Argument;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Cspray\AnnotatedConsole\Input\Argument
 */
class ArgumentTest extends TestCase {

    public function testAsInputArgumentRequiredArray() : void {
        $argument = new Argument(
            'my-name',
            'My description',
            Argument::Required | Argument::IsArray
        );

        $input = $argument->asInputArgument();

        self::assertSame('my-name', $input->getName());
        self::assertSame('My description', $input->getDescription());
        self::assertTrue($input->isRequired());
        self::assertSame([], $input->getDefault());
        self::assertTrue($input->isArray());
    }

    public function testAsInputArgumentOptionalArray() : void {
        $argument = new Argument(
            'optional-array-name',
            'My description',
            Argument::IsArray | Argument::Optional,
        );

        $input = $argument->asInputArgument();

        self::assertSame('optional-array-name', $input->getName());
        self::assertSame('My description', $input->getDescription());
        self::assertFalse($input->isRequired());
        self::assertSame([], $input->getDefault());
        self::assertTrue($input->isArray());
    }

    public function testAsInputArgumentRequireNonArray() : void {
        $argument = new Argument(
            'optional-non-array',
            'My non-array description',
            Argument::Required
        );

        $input = $argument->asInputArgument();

        self::assertSame('optional-non-array', $input->getName());
        self::assertSame('My non-array description', $input->getDescription());
        self::assertFalse($input->isArray());
        self::assertTrue($input->isRequired());
        self::assertSame(null, $input->getDefault());
    }

}
