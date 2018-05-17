<?php

namespace Tests;

use Codinc\Type\Enum;

/**
 * Class MyEnum
 *
 * @package Tests
 */
class MyEnum extends Enum
{
    public const FIRST = 'first';
    public const PERSONAL = 'personal';
    public const FOO = 'BAR';
    public const BAR = 'FOO';
}