# phpEnum
A simple PHP Enum implementation, as an alternative to SplEnum, allowing typesafety for values belonging to an enum.

## Usage
The abstract class supports extension by a concrete class(es) that define constants as valid values.

```$xslt
class MyEnum extends Enum
{
    const PERSONAL = 'personal';
    const TEAM = 'team';
}
```

It is supported to call the constant as a method without added overhead. In case you do desire autocompletion benefits
you can still define the public static methods yourself and call load on the Enum.


```$xslt
class MyEnum extends Enum
{
    const PERSONAL = 'personal';
    const TEAM = 'team';
    const WORLD = 'world';
    
    public static function WORLD()
    {
        return self::load(self::WORLD);
    }
}
```

```$xslt
$personal = MyEnum::PERSONAL();
$world = MyEnum::WORLD();
```

The Enum keeps track of the instantiated objects to ensure only one instance can be used, allowing native strict comparisson.

```$xslt
MyEnum::PERSONAL() === MyEnum::PERSONAL(); // === true
```

Unsupported values will throw an \InvalidArgumentException.

```$xslt
MyEnum::load('personal'); // === MyEnum::PERSONAL()
MyEnum::load('made_up'); // throws \InvalidArgumentException
```
