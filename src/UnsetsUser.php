<?php

namespace Mpyw\NullAuth;

/**
 * Trait UnsetsUser
 *
 * Standard non-stateful Guard does not provide a way to unset $user.
 * This trait make unsetting user possible.
 */
trait UnsetsUser
{
    /**
     * Unset the current user.
     *
     * @return $this
     */
    public function unsetUser(): static
    {
        $this->user = null;

        return $this;
    }
}
