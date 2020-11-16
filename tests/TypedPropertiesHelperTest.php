<?php /** @noinspection PhpMissingFieldTypeInspection */

declare(strict_types=1);

namespace Kenny1911\TypedProperties\Tests;

use Kenny1911\TypedProperties\TypedPropertiesHelper;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use stdClass;

class TypedPropertiesHelperTest extends TestCase
{
    public function testIsInitialized()
    {
        $obj = new class {
            public $notTyped;
            public string $initialized = 'Foo';
            public string $notInitialized;
            protected string $protected = 'protected';
            protected string $protectedNotInitialized;
        };

        $this->assertTrue(TypedPropertiesHelper::isInitialized($obj, 'notTyped'));
        $this->assertTrue(TypedPropertiesHelper::isInitialized($obj, 'initialized'));
        $this->assertFalse(TypedPropertiesHelper::isInitialized($obj, 'notInitialized'));
        $this->assertTrue(TypedPropertiesHelper::isInitialized($obj, 'protected'));
        $this->assertFalse(TypedPropertiesHelper::isInitialized($obj, 'protectedNotInitialized'));

        unset($obj->notTyped);
        unset($obj->initialized);
        $obj->notInitialized = 'Bar';

        $this->assertFalse(TypedPropertiesHelper::isInitialized($obj, 'notTyped'));
        $this->assertFalse(TypedPropertiesHelper::isInitialized($obj, 'initialized'));
        $this->assertTrue(TypedPropertiesHelper::isInitialized($obj, 'notInitialized'));
    }

    public function testIsTyped()
    {
        $obj = new class {
            public $foo;
            public string $bar;
            public string $baz = 'Baz';
            protected $protected;
            protected string $protectedTyped = 'protected';
            protected string $protectedTypedNotInitialized;
        };

        $this->assertFalse(TypedPropertiesHelper::isTyped($obj, 'foo'));
        $this->assertTrue(TypedPropertiesHelper::isTyped($obj, 'bar'));
        $this->assertTrue(TypedPropertiesHelper::isTyped($obj, 'baz'));
        $this->assertFalse(TypedPropertiesHelper::isTyped($obj, 'protected'));
        $this->assertTrue(TypedPropertiesHelper::isTyped($obj, 'protectedTyped'));
        $this->assertTrue(TypedPropertiesHelper::isTyped($obj, 'protectedTypedNotInitialized'));
    }

    public function testPropertyNotExists()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Property stdClass::$invalid does not exist');

        TypedPropertiesHelper::isInitialized(new stdClass(), 'invalid');
    }
}
