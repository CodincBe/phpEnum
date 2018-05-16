<?php

namespace Tests;

use Codinc\Type\Enum;

/**
 * Class Example
 *
 * @package Tests
 */
class Example extends Enum
{
    public const FIRST = 'first';
    public const SECOND = 'second';
    public const THIRD = 'third';
    private const SECRET = 'secret';

    /**
     * Autocompletion assistance example
     *
     * @return Example
     */
    public static function THIRD()
    {
        return self::load(self::THIRD);
    }

    /**
     * Protecting the constant itself
     *
     * @return Example
     */
    public static function SECRET()
    {
        return self::load(self::SECRET);
    }
}