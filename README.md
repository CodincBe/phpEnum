# phpEnum
A simple PHP Enum implementation, as an alternative to SplEnum, allowing typesafety for values belonging to an enum.

## Installation
`composer require codinc/phpenum`

## Usage
The abstract class supports extension by concrete classes that define constants as valid values.

```$xslt
use Codinc\Type\Enum;

class MyEnum extends Enum
{
    const PERSONAL = 'personal';
    const TEAM = 'team';
}
```

Of course, the biggest advantage of an enum is to allow typehinting and built-in safety on methods on your set of values.

```$xslt
public function doAnAction(MyEnum $value)
{
    // Can only contain PERSONAL or TEAM
}
```

The biggest advantage and difference of this implementation is that it is allowing native strict comparison.
The Enum keeps track of the instantiated objects to ensure only one instance can be used.

```$xslt
MyEnum::PERSONAL() === MyEnum::PERSONAL(); // === true
```

It is supported to call the constant as a method without added overhead. In case you do desire the benefits of autocompletion, or desire to protect your constants, you can still define the public static methods yourself and call load on the Enum.


```$xslt
use Codinc\Type\Enum;

class MyEnum extends Enum
{
    const PERSONAL = 'personal';
    const TEAM = 'team';
    const WORLD = 'world';
    private const COMPANY = 'company';
    
    public static function WORLD()
    {
        return self::load(self::WORLD);
    }
    
    public static function COMPANY()
    {
        return self::load(self::COMPANY);
    }
}
```

```$xslt
$personal = MyEnum::PERSONAL();
$world = MyEnum::WORLD();
```

Unsupported values will throw an \InvalidArgumentException.

```$xslt
MyEnum::load('personal'); // === MyEnum::PERSONAL()
MyEnum::load('made_up'); // throws \InvalidArgumentException
MyEnum::load($repository->fetchColumn($column));
```
