<?php

namespace Mpyw\NullAuth;

trait GenericNullAuthenticatable
{
    use Concerns\RequiresIdentifier;

    /**
     * Get the password for the user.
     */
    public function getAuthPassword(): string
    {
        return '';
    }

    /**
     * Get the token value for the "remember me" session.
     */
    public function getRememberToken(): string
    {
        return '';
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     */
    public function setRememberToken($value): void
    {
    }

    /**
     * Get the column name for the "remember me" token.
     */
    public function getRememberTokenName(): string
    {
        return '';
    }
}
