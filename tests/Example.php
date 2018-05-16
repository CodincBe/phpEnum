<?php

namespace Tests;

use CodincBe\Type\Enum;

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

    /**
     * Autocompletion assistance example
     *
     * @return Example
     */
    public static function THIRD()
    {
        return self::load(self::THIRD);
    }
}