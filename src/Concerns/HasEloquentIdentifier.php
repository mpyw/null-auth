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
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getKeyName()};
    }
}
