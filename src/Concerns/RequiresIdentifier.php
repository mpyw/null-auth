<?php

namespace Mpyw\NullAuth\Concerns;

trait RequiresIdentifier
{
    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    abstract public function getAuthIdentifierName();

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    abstract public function getAuthIdentifier();
}
