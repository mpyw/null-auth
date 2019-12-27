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
     *
     * @return mixed
     */
    public function getAuthPassword()
    {
        return $this->getAttribute('password');
    }
}
