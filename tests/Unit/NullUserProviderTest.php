<?php

namespace Mpyw\NullAuth\Tests\Unit;

use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\UserProvider;
use Mpyw\NullAuth\NullUserProvider;
use Mpyw\NullAuth\Tests\TestCase;

class NullUserProviderTest extends TestCase
{
    protected UserProvider $provider;

    public function testGetAuthP(): void
    {
        $this->provider = new NullUserProvider();
        $this->assertNull($this->provider->retrieveById(123));
    }

    public function testRetrieveByToken(): void
    {
        $this->provider = new NullUserProvider();
        $this->assertNull($this->provider->retrieveByToken(123, 'xxx'));
    }

    public function testUpdateRememberToken(): void
    {
        $this->provider = new NullUserProvider();
        $this->provider->updateRememberToken(new GenericUser([]), false);
        $this->assertTrue(true);
    }

    public function testRetrieveByCredentials(): void
    {
        $this->provider = new NullUserProvider();
        $this->assertNull($this->provider->retrieveByCredentials(['email' => 'xxx@example.com', 'password' => 'abc123']));
    }

    public function testValidateCredentials(): void
    {
        $this->provider = new NullUserProvider();
        $this->assertFalse($this->provider->validateCredentials(new GenericUser([[]]), ['email' => 'xxx@example.com', 'password' => 'abc123']));
    }
}
