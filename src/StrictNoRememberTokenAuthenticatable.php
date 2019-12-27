<?php

namespace Mpyw\NullAuth;

use Mpyw\NullAuth\Concerns\HasEloquentPassword;

trait StrictNoRememberTokenAuthenticatable
{
    use StrictNullAuthenticatable,
        HasEloquentPassword {
        HasEloquentPassword::getAuthPassword insteadof StrictNullAuthenticatable;
    }
}
