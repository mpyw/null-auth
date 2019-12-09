<?php

namespace Mpyw\NullAuth;

use Illuminate\Contracts\Auth\Guard;
use Mpyw\NullAuth\Concerns\GuardsNothing;

class NullGuard implements Guard
{
    use GuardsNothing, UnsetsUser;
}
