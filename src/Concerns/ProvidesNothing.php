<?php

namespace Mpyw\NullAuth\Concerns;

use Illuminate\Contracts\Auth\Authenticatable;

trait ProvidesNothing
{
    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed                                           $identifier
     * @return null|\Illuminate\Contracts\Auth\Authenticatable
     */
    public function retrieveById($identifier)
    {
        return null;
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed                                           $identifier
     * @param  string                                          $token
     * @return null|\Illuminate\Contracts\Auth\Authenticatable
     */
    public function retrieveByToken($identifier, $token)
    {
        return null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  string                                     $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array                                           $credentials
     * @return null|\Illuminate\Contracts\Auth\Authenticatable
     */
    public function retrieveByCredentials(array $credentials)
    {
        return null;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  array                                      $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return false;
    }
}
