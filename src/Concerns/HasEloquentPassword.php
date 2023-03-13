<?php

namespace Mpyw\NullAuth\Concerns;

/**
 * Trait HasEloquentPassword
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasEloquentPassword
{
    /**
     * Get the unique identifier for the user.
     */
    public function getAuthPassword(): mixed
    {
        return $this->getAttribute('password');
    }
}
