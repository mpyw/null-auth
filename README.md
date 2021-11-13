# Null Auth [![Build Status](https://github.com/mpyw/null-auth/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/mpyw/null-auth/actions) [![Coverage Status](https://coveralls.io/repos/github/mpyw/null-auth/badge.svg?branch=master)](https://coveralls.io/github/mpyw/null-auth?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mpyw/null-auth/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mpyw/null-auth/?branch=master)

<p align="center">
<img src="https://user-images.githubusercontent.com/1351893/70479968-e64e8e00-1b21-11ea-83c6-1d5e51f7e3e5.png">
</p>

Null Guard for Laravel. Designed for Middleware-based authentication and testing.

## Requirements

- PHP: `^7.3 || ^8.0`
- Laravel: `^6.0 || ^7.0 || ^8.0 || ^9.0`

## Installing

```bash
composer require mpyw/null-auth
```

## Features

### `NullAuthenticatable` family

| Trait | ID | Password | Remember Token |
|:---|:---:|:---:|:---:|
| `GenericNullAuthenticatable`<br>`GenericStrictNullAuthenticatable` | ❗️ | ❌| ❌|
| `NullAuthenticatable`<br>`StrictNullAuthenticatable` | ✅| ❌| ❌|
| `NoRememberTokenAuthenticatable`<br>`StrictNoRememberTokenAuthenticatable` | ✅| ✅| ❌|

- ❗️shows containing abstract methods.
- `Strict` traits throw `BadMethodCallException` on bad method calls.

### `NullGuard`

- `NullGuard::user()` always returns Authenticatable already set by `NullGuard::setUser()`.
- `NullGuard::unsetUser()` can unset user.

### `NullUserProvider`

- All methods do nothing and always returns falsy value.

## Usage

### Basic Usage

Edit your **`config/auth.php`**.

```php
<?php

return [

    /* ... */

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'null', // Use NullGuard for "web"
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'null', // Use NullUserProvider for "users"
        ],
        
        // 'users' => [
        //     'driver' => 'eloquent',
        //     'model' => App\User::class,
        // ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /* ... */
];
```

## Motivation

### Guard-based API Authentication

Consider authentication that sends HTTP requests to the external platform.

In such a situation, you will probably use [`RequestGuard`] through [`Auth::viaRequest()`] call.
However, some methods on the contracts [`UserProvider`] and [`Authenticatable`] are unsuitable for that.
They heavily rely on the following flow:

1. Retrieve a user from database by email address
2. Verify user's password hash

This library provides a helper that makes the useless contract methods to do nothing; always return nullish or falsy values.

Now we include **`NullAuthenticatable`** trait on a user model.

```php
<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Mpyw\NullAuth\NullAuthenticatable;

class User extends Model implements Authenticatable
{
    use NullAuthenticatable;
}
```

Then only **[`getAuthIdentifierName()`]** and **[`getAuthIdentifier()`]** are provided as a valid implementation.

```php
<?php

$user = User::find(1);

// Minimal implementation for Authenticatable
var_dump($user->getAuthIdentifierName()); // string(2) "id"
var_dump($user->getAuthIdentifier());     // int(1)

// Useless implementation for Authenticatable when we don't use StatefulGuard
var_dump($user->getAuthPassword());       // string(0) ""
var_dump($user->getRememberTokenName());  // string(0) ""
var_dump($user->getRememberToken());      // string(0) ""
$user->setRememberToken('...');           // Does nothing
```

### Middleware-based Authentication

Suppose you hate using [`RequestGuard`] and wish implementing authentication on middleware.

Methods such as [`Auth::user()`] cause side effects when called for the first time on each request.
This may lead to inappropriate behaviors if you concentrate authentication on middleware
and use [`Auth::user()`] only as a container for [`Authenticatable`] object.

Don't worry. This library provides **`NullGuard`**,
which is exactly as a simple [`Authenticatable`] container that you want.
[`Auth::user()`] does nothing but returning the cached [`Authenticatable`].
You can just focus on calling [`Auth::setUser()`] on your cool middleware at ease.

```php
<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Example\API\Authentication\Client;

class AuthenticateThroughExternalAPI
{
    /**
     * @var \Example\API\Authentication\Client
     */
    protected $client;

    /**
     * @param \Example\API\Authentication\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Return user_id on success, throw AuthenticationException on failure
        $userId = $this->client->authenticate($request->input('token'));

        // Return User on success, throw ModelNotFoundException on failure
        $user = User::findOrFail($userId);

        Auth::setUser($user);

        return $next($request);
    }
}

```

### Testing

Needless to say, it is also useful for testing.
There is no worry about causing side effects.

[`RequestGuard`]: https://github.com/illuminate/auth/blob/master/RequestGuard.php
[`Auth::viaRequest()`]: https://github.com/illuminate/auth/blob/7b2297b6cd5e7000b31caca40399c33832237649/AuthManager.php#L219-L235
[`UserProvider`]: https://github.com/illuminate/contracts/blob/master/Auth/UserProvider.php
[`Authenticatable`]: https://github.com/illuminate/contracts/blob/master/Auth/Authenticatable.php
[`getAuthIdentifierName()`]: https://github.com/illuminate/contracts/blob/6b0122dc740d6db5ab8b1187af313c6e65afeb55/Auth/Authenticatable.php#L7-L12
[`getAuthIdentifier()`]: https://github.com/illuminate/contracts/blob/6b0122dc740d6db5ab8b1187af313c6e65afeb55/Auth/Authenticatable.php#L14-L19
[`Auth::user()`]: https://github.com/illuminate/contracts/blob/6b0122dc740d6db5ab8b1187af313c6e65afeb55/Auth/Guard.php#L21-L26
[`Auth::setUser()`]: https://github.com/illuminate/contracts/blob/6b0122dc740d6db5ab8b1187af313c6e65afeb55/Auth/Guard.php#L43-L49
