<?php

namespace Mpyw\NullAuth\Concerns;

use Illuminate\Auth\GuardHelpers;

trait GuardsNothing
{
    use GuardHelpers;

    /**
     * Get the currently authenticated user.
     *
     * @return null|\Illuminate\Contracts\Auth\Authenticatable
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        return false;
    }
}
