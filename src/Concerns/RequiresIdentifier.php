<?php

namespace Mpyw\NullAuth\Concerns;

trait RequiresIdentifier
{
    /**
     * Get the name of the unique identifier for the user.
     */
    abstract public function getAuthIdentifierName(): string;

    /**
     * Get the unique identifier for the user.
     */
    abstract public function getAuthIdentifier(): mixed;
}
