<?php

namespace Mpyw\NullAuth;

use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class NullAuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        /* @noinspection PhpUnhandledExceptionInspection */
        $this->app->resolved(AuthManager::class)
            ? static::extendComponents($this->app->make(AuthManager::class)) // @codeCoverageIgnore
            : $this->app->afterResolving(AuthManager::class, Closure::fromCallable([$this, 'extendComponents']));
    }

    protected function extendComponents(AuthManager $auth): void
    {
        $auth->extend('null', function (Container $app, string $name, array $config) use ($auth) {
            $guard = new NullGuard();
            $guard->setProvider($auth->createUserProvider($config['provider'] ?? null));
            return $guard;
        });

        $auth->provider('null', function () {
            return new NullUserProvider();
        });
    }
}
