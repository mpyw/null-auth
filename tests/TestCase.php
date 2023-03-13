<?php

namespace Mpyw\NullAuth\Tests;

use Mpyw\NullAuth\NullAuthServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getPackageProviders($app): array
    {
        return [
            NullAuthServiceProvider::class,
        ];
    }
}
