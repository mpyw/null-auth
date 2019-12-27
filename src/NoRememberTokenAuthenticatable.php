<?php

namespace Mpyw\NullAuth;

use Mpyw\NullAuth\Concerns\HasEloquentPassword;

trait NoRememberTokenAuthenticatable
{
    use NullAuthenticatable,
        HasEloquentPassword {
        HasEloquentPassword::getAuthPassword insteadof NullAuthenticatable;
    }
}
