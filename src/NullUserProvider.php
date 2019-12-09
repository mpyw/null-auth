<?php

namespace Mpyw\NullAuth;

use Illuminate\Contracts\Auth\UserProvider;
use Mpyw\NullAuth\Concerns\ProvidesNothing;

class NullUserProvider implements UserProvider
{
    use ProvidesNothing;
}
