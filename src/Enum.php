<?php

namespace Codinc\Type;

use InvalidArgumentException;
use LogicException;
use ReflectionClass;
use ReflectionException;

/**
 * Class Enum
 *
 * @package Codinc\Type
 */
abstract class Enum
{
    /**
     * @var Enum[][]
     */
    private static $instances = [];

    /**
     * @var string[][]
     */
    private static $types = [];

    /**
     * @var string
     */
    private $value;

    /**
     * Supporting use of CallingClass::CONSTANT()
     *
     * @param string $name
     * @param array $arguments
     * @return static
     */
    public static function __callStatic($name, $arguments): Enum
    {
        $supported = &self::all();
        if (!isset($supported[$name])) {
            throw new InvalidArgumentException("The type $name is not found and cannot be instantiated");
        }
        return self::load($supported[$name]);
    }

    /**
     * @return array
     */
    public static function all(): array
    {
        if (!isset(self::$types[static::class])) {
            self::$types[static::class] = [];
            try {
                $class = new ReflectionClass(static::class);
                foreach ($class->getConstants() as $constant => $value) {
                    self::$types[static::class][$constant] = $value;
                }
            } catch (ReflectionException $e) {
                // Ignore
            }
        }
        return self::$types[static::class];
    }

    /**
     * Ensure only one instance is loaded and kept in memory (allowing strict object comparison)
     *
     * @param string $value
     * @return static
     */
    public static function load(string $value): Enum
    {
        if (!isset(self::$instances[static::class][$value])) {
            self::$instances[static::class][$value] = new static($value);
        }
        return self::$instances[static::class][$value];
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function isSupported(string $value): bool
    {
        return in_array($value, self::all());
    }

    /**
     * Enum constructor.
     *
     * @param string $value
     */
    final protected function __construct(string $value)
    {
        if (!self::isSupported($value)) {
            throw new InvalidArgumentException("$value is not supported by " . static::class);
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * Prevent cloning the object
     */
    public function __clone()
    {
        throw new LogicException('It is not allowed to clone an Enum');
    }

    /**
     * @param Enum $other
     * @return bool
     */
    public function equals(Enum $other): bool
    {
        return $this === $other;
    }
}