<?php

declare(strict_types=1);

namespace Kenny1911\TypedProperties;

use ReflectionException;
use ReflectionProperty;
use RuntimeException;

class TypedPropertiesHelper
{
    /**
     * Check, that object property is initialized.
     */
    public static function isInitialized(object $obj, string $prop): bool
    {
        $ref = static::getProperty($obj, $prop);
        $ref->setAccessible(true);

        return $ref->isInitialized($obj);
    }

    /**
     * Check, that object property is typed.
     */
    public static function isTyped(object $obj, string $prop): bool
    {
        return static::getProperty($obj, $prop)->hasType();
    }

    private static function getProperty(object $obj, string $prop): ReflectionProperty
    {
        try {
            return new ReflectionProperty($obj, $prop);
        } catch (ReflectionException $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
}