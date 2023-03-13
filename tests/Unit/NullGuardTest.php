<?php

namespace Mpyw\NullAuth\Tests\Unit;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Mockery;
use Mpyw\NullAuth\NullGuard;
use Mpyw\NullAuth\Tests\TestCase;

class NullGuardTest extends TestCase
{
    /**
     * @var \Illuminate\Auth\GuardHelpers|\Illuminate\Contracts\Auth\Guard|\Mpyw\NullAuth\NullGuard
     */
    protected $guard;
    protected Authenticatable $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = new GenericUser(['id' => 123, 'email' => 'xxx@example.com', 'password' => 'abc123']);
    }

    public function testUser(): void
    {
        $this->guard = new NullGuard();
        $this->guard->setUser($this->user);
        $this->assertSame($this->user, $this->guard->user());

        $this->guard = new NullGuard();
        $this->guard->unsetUser();
        $this->assertNull($this->guard->user());
    }

    public function testValidate(): void
    {
        $this->guard = Mockery::mock(NullGuard::class . '[user]');
        $this->assertFalse($this->guard->validate(['email' => 'xxx@example.com', 'password' => 'abc123']));
        $this->guard->shouldNotHaveReceived('user');

        $this->guard = Mockery::mock(NullGuard::class . '[user]');
        $this->assertFalse($this->guard->validate(['email' => 'xxx@example.com', 'password' => 'abc123']));
        $this->guard->shouldNotHaveReceived('user');
    }

    /**
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function testAuthenticate(): void
    {
        $this->guard = Mockery::mock(NullGuard::class . '[user]');
        $this->guard->shouldReceive('user')->andReturn($this->user);
        $this->assertSame($this->user, $this->guard->authenticate());

        $this->guard = Mockery::mock(NullGuard::class . '[user]');
        $this->guard->shouldReceive('user')->andReturn(null);
        $this->expectException(AuthenticationException::class);
        $this->guard->authenticate();
    }

    public function testHasUser(): void
    {
        $this->guard = Mockery::mock(NullGuard::class . '[user]');
        $this->guard->setUser($this->user);
        $this->assertTrue($this->guard->hasUser());
        $this->guard->shouldNotHaveReceived('user');

        $this->guard = Mockery::mock(NullGuard::class . '[user]');
        $this->guard->unsetUser();
        $this->assertFalse($this->guard->hasUser());
        $this->guard->shouldNotHaveReceived('user');
    }

    public function testCheck(): void
    {
        $this->guard = Mockery::mock(NullGuard::class . '[user]');
        $this->guard->shouldReceive('user')->andReturn($this->user);
        $this->assertTrue($this->guard->check());

        $this->guard = Mockery::mock(NullGuard::class . '[user]');
        $this->guard->shouldReceive('user')->andReturn(null);
        $this->assertFalse($this->guard->check());
    }

    public function testGuest(): void
    {
        $this->guard = Mockery::mock(NullGuard::class . '[check]');
        $this->guard->shouldReceive('check')->andReturn(true);
        $this->assertFalse($this->guard->guest());

        $this->guard = Mockery::mock(NullGuard::class . '[check]');
        $this->guard->shouldReceive('check')->andReturn(false);
        $this->assertTrue($this->guard->guest());
    }

    public function id(): void
    {
        $this->guard = Mockery::mock(NullGuard::class . '[user]');
        $this->guard->shouldReceive('user')->andReturn($this->user);
        $this->assertSame(123, $this->guard->id());

        $this->guard = Mockery::mock(NullGuard::class . '[user]');
        $this->guard->shouldReceive('user')->andReturn(null);
        $this->assertNull($this->guard->id());
    }
}
