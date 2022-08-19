<?php

namespace Cspray\AnnotatedConsole\Unit\Input;

use Cspray\AnnotatedConsole\Input\Opt;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Cspray\AnnotatedConsole\Input\Opt
 */
final class OptionTest extends TestCase {

    public function testOptionNameWithDefaults() : void {
        $option = new Opt('opt-name');

        $input = $option->asInputOption();

        self::assertSame('opt-name', $input->getName());
        self::assertNull($input->getShortcut());
        self::assertSame('', $input->getDescription());
        self::assertFalse($input->isArray());
        self::assertFalse($input->isValueOptional());
        self::assertFalse($input->isValueRequired());
        self::assertFalse($input->isNegatable());
        self::assertFalse($input->getDefault());
    }

    public function testOptionWithShortcut() : void {
        $option = new Opt('opt-long', 'o');

        $input = $option->asInputOption();

        self::assertSame('opt-long', $input->getName());
        self::assertSame('o', $input->getShortcut());
        self::assertSame('', $input->getDescription());
        self::assertFalse($input->isArray());
        self::assertFalse($input->isValueOptional());
        self::assertFalse($input->isValueRequired());
        self::assertFalse($input->isNegatable());
        self::assertFalse($input->getDefault());
    }

    public function testOptionWithDescription() : void {
        $option = new Opt('opt-desc', description: 'Option description');
        $input = $option->asInputOption();

        self::assertSame('opt-desc', $input->getName());
        self::assertNull($input->getShortcut());
        self::assertSame('Option description', $input->getDescription());
        self::assertFalse($input->isArray());
        self::assertFalse($input->isValueOptional());
        self::assertFalse($input->isValueRequired());
        self::assertFalse($input->isNegatable());
        self::assertFalse($input->getDefault());
    }

    public function testOptionWithMode() : void {
        $option = new Opt('opt-desc', mode: Opt::IsArray | Opt::Required);
        $input = $option->asInputOption();

        self::assertSame('opt-desc', $input->getName());
        self::assertNull($input->getShortcut());
        self::assertSame('', $input->getDescription());
        self::assertTrue($input->isArray());
        self::assertFalse($input->isValueOptional());
        self::assertTrue($input->isValueRequired());
        self::assertFalse($input->isNegatable());
        self::assertSame([], $input->getDefault());
    }

    public function testOptionWithDefaultValue() : void {
        $option = new Opt('opt-default', mode: Opt::Required, default: 'my-default-value');
        $input = $option->asInputOption();

        self::assertSame('opt-default', $input->getName());
        self::assertNull($input->getShortcut());
        self::assertSame('', $input->getDescription());
        self::assertFalse($input->isArray());
        self::assertFalse($input->isValueOptional());
        self::assertTrue($input->isValueRequired());
        self::assertFalse($input->isNegatable());
        self::assertSame('my-default-value', $input->getDefault());
    }

}