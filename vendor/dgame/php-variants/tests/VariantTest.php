<?php

namespace Dgame\Variants\Test;

use Dgame\Variants\Variants;
use PHPUnit\Framework\TestCase;

final class VariantTest extends TestCase
{
    public function testWithPattern()
    {
        $value    = '016945236589';
        $patterns = [
            '/(\d{4})(\d+)/' => ['$1/$2', '$1-$2']
        ];

        $this->assertEquals(['0169/45236589', '0169-45236589'], Variants::ofArguments($value)->withPattern($patterns));
    }

    public function testWithUpperLowerCaseFirst()
    {
        $this->assertEquals(['foo', 'Foo', 'bar', 'Bar'], Variants::ofArray(['foo', 'bar'])->withUpperLowerCaseFirst());
    }

    public function testWithUpperLowerCase()
    {
        $this->assertEquals(['foo', 'FOO', 'bar', 'BAR'], Variants::ofArray(['foo', 'bar'])->withUpperLowerCase());
        $this->assertEquals(['foo', 'FOO', 'bar', 'BAR'], Variants::ofArray(['fOo', 'bAr'])->withUpperLowerCase());
    }

    public function testWithCamelSnakeCase()
    {
        $this->assertEquals(
            ['callAMethod', 'CallAMethod', 'call_a_method'],
            Variants::ofArguments('call a method')->withCamelSnakeCase()
        );
    }

    public function testAssembled()
    {
        $this->assertEquals(
            ['callAMethod', 'CallAMethod', 'call_a_method', 'call-a-method'],
            Variants::ofArguments('call a method')->assembled()
        );
    }
}