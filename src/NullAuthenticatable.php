<?php

namespace Mpyw\NullAuth;

trait NullAuthenticatable
{
    use GenericNullAuthenticatable,
        Concerns\HasEloquentIdentifier;
}
