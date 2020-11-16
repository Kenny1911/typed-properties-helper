<?php

declare(strict_types=1);

namespace Kenny1911\TypedProperties;

/**
 * Check, that object property is initialized.
 *
 * Wrapper of {@see TypedPropertiesHelper::isInitialized()}.
 */
function is_initialized(object $obj, string $prop): bool
{
    return TypedPropertiesHelper::isInitialized($obj, $prop);
}

/**
 * Check, that object property is typed.
 *
 * Wrapper of {@see TypedPropertiesHelper::isTyped()}.
 */
function is_typed(object $obj, string $prop): bool
{
    return TypedPropertiesHelper::isTyped($obj, $prop);
}
