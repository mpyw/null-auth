<?php

namespace Mpyw\NullAuth;

use LogicException;

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
        throw new LogicException('Not implemented');
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        throw new LogicException('Not implemented');
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     */
    public function setRememberToken($value)
    {
        throw new LogicException('Not implemented');
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        throw new LogicException('Not implemented');
    }
}
