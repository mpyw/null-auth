<?php

namespace Mpyw\NullAuth\Concerns;

use Illuminate\Contracts\Auth\Authenticatable;

trait ProvidesNothing
{
    /**
     * Retrieve a user by their unique identifier.
     *
     * @param mixed $identifier
     */
    public function retrieveById($identifier): ?Authenticatable
    {
        return null;
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param mixed $identifier
     * @param string $token
     */
    public function retrieveByToken($identifier, $token): ?Authenticatable
    {
        return null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param string $token
     */
    public function updateRememberToken(Authenticatable $user, $token): void
    {
    }

    /**
     * Retrieve a user by the given credentials.
     */
    public function retrieveByCredentials(array $credentials): ?Authenticatable
    {
        return null;
    }

    /**
     * Validate a user against the given credentials.
     */
    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        return false;
    }

    /**
     * Rehash the user's password if required and supported.
     */
    public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, bool $force = false)
    {
    }
}
