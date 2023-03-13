<?php

namespace Mpyw\NullAuth;

use BadMethodCallException;

trait GenericStrictNullAuthenticatable
{
    use Concerns\RequiresIdentifier;

    /**
     * Get the password for the user.
     */
    public function getAuthPassword(): string
    {
        throw new BadMethodCallException('Not implemented');
    }

    /**
     * Get the token value for the "remember me" session.
     */
    public function getRememberToken(): string
    {
        throw new BadMethodCallException('Not implemented');
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     */
    public function setRememberToken($value): void
    {
        throw new BadMethodCallException('Not implemented');
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName(): string
    {
        throw new BadMethodCallException('Not implemented');
    }
}
