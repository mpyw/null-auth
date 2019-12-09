<?php

namespace Mpyw\NullAuth\Tests;

use Mpyw\NullAuth\NullAuthServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            NullAuthServiceProvider::class,
        ];
    }
}
