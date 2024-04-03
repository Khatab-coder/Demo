<?php

namespace Dgame\Variants;

use ICanBoogie\Inflector;

/**
 * Class Variants
 * @package Dgame\Variants
 */
class Variants
{
    /**
     * @var string[]
     */
    private $values = [];

    /**
     * Variants constructor.
     *
     * @param string[] $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @return string[]
     */
    final public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param string[] ...$values
     *
     * @return Variants
     */
    public static function ofArguments(string ...$values): self
    {
        return new self($values);
    }

    /**
     * @param array $values
     *
     * @return Variants
     */
    public static function ofArray(array $values): self
    {
        return new self($values);
    }

    /**
     * @param callable[] ...$callbacks
     *
     * @return string[]
     */
    final public function with(callable ...$callbacks): array
    {
        $output = [];
        foreach ($this->values as $value) {
            foreach ($callbacks as $callback) {
                $output[] = $callback($value);
            }
        }

        return $output;
    }

    /**
     * @param array $patterns
     *
     * @return string[]
     */
    final public function withPattern(array $patterns): array
    {
        $output = [];
        foreach ($this->values as $value) {
            foreach ($patterns as $pattern => $replacement) {
                if (is_array($replacement)) {
                    $output = array_merge(self::replaceArray($pattern, $replacement, $value));
                } else {
                    $output[] = self::replace($pattern, $replacement, $value);
                }
            }
        }

        return $output;
    }

    /**
     * @param string $pattern
     * @param array  $replacements
     * @param string $value
     *
     * @return array
     */
    private static function replaceArray(string $pattern, array $replacements, string $value): array
    {
        $output = [];
        foreach ($replacements as $replacement) {
            $output[] = self::replace($pattern, $replacement, $value);
        }

        return $output;
    }

    /**
     * @param string $pattern
     * @param string $replacement
     * @param string $value
     *
     * @return string
     */
    private static function replace(string $pattern, string $replacement, string $value): string
    {
        return preg_replace($pattern, $replacement, $value);
    }

    /**
     * @return string[]
     */
    final public function withUpperLowerCaseFirst(): array
    {
        return $this->with('lcfirst', 'ucfirst');
    }

    /**
     * @return string[]
     */
    final public function withUpperLowerCase(): array
    {
        return $this->with('strtolower', 'strtoupper');
    }

    /**
     * @return string[]
     */
    final public function withCamelSnakeCase(): array
    {
        $output = [];
        foreach ($this->values as $value) {
            $value = self::replaceWhitespaces($value);

            $output[] = Inflector::get()->camelize($value, Inflector::DOWNCASE_FIRST_LETTER);
            $output[] = Inflector::get()->camelize($value, Inflector::UPCASE_FIRST_LETTER);
            $output[] = Inflector::get()->underscore($value);
        }

        return $output;
    }

    /**
     * @return array
     */
    final public function assembled(): array
    {
        $output = $this->withCamelSnakeCase();
        foreach ($this->values as $value) {
            $output[] = Inflector::get()->dasherize(self::replaceWhitespaces($value));
        }

        return $output;
    }

    /**
     * @param string $value
     *
     * @return string
     */
    private static function replaceWhitespaces(string $value): string
    {
        return preg_replace('/\s+/', '_', trim($value));
    }
}