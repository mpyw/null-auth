<?php

namespace Mpyw\NullAuth;

trait StrictNullAuthenticatable
{
    use GenericStrictNullAuthenticatable,
        Concerns\HasEloquentIdentifier;
}
