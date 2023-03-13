<?php

namespace Mpyw\NullAuth\Concerns;

/**
 * Trait HasEloquentIdentifier
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasEloquentIdentifier
{
    /**
     * Get the name of the unique identifier for the user.
     */
    public function getAuthIdentifierName(): string
    {
        return $this->getKeyName();
    }

    /**
     * Get the unique identifier for the user.
     */
    public function getAuthIdentifier(): mixed
    {
        return $this->{$this->getKeyName()};
    }
}
