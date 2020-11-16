# TypedPropertiesHelper

`TypedPropertiesHelper` is a set of helper function to working with typed class properties.

## Installation

```bash
composer require kenny1911/typed-properties-helper
```

## Usage

Check, that object property initialized:

```php
use function Kenny1911\TypedProperties\is_initialized;

$obj = new class {
    public int $init = 123;
    public int $notInit;
};

is_initialized($obj, 'init');       // True
is_initialized($obj, 'notInit');    // False
```

Check, that object property typed:

```php
use function Kenny1911\TypedProperties\is_typed;

$obj = new class {
    public int $typed;
    public $notTyped;
};

is_typed($obj, 'typed');        // True
is_typed($obj, 'notTyped');     // False
```