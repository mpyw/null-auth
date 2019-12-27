<?php

namespace Mpyw\NullAuth;

use BadMethodCallException;

trait GenericStrictNullAuthenticatable
{
    use Concerns\RequiresIdentifier;

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        throw new BadMethodCallException('Not implemented');
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        throw new BadMethodCallException('Not implemented');
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     */
    public function setRememberToken($value)
    {
        throw new BadMethodCallException('Not implemented');
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        throw new BadMethodCallException('Not implemented');
    }
}
