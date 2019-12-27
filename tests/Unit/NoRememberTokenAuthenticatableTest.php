<?php

namespace Mpyw\NullAuth\Tests\Unit;

use BadMethodCallException;
use Illuminate\Auth\GenericUser;
use Mpyw\NullAuth\NoRememberTokenAuthenticatable;
use Mpyw\NullAuth\StrictNoRememberTokenAuthenticatable;
use Mpyw\NullAuth\Tests\TestCase;

class NoRememberTokenAuthenticatableTest extends TestCase
{
    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var \Illuminate\Auth\GenericUser|\Mpyw\NullAuth\NoRememberTokenAuthenticatable
     */
    protected $user;

    /**
     * @var \Illuminate\Auth\GenericUser|\Mpyw\NullAuth\NoRememberTokenAuthenticatable
     */
    protected $strict;

    public function setUp(): void
    {
        parent::setUp();

        $this->attributes = [
            'id' => 123,
            'password' => 'foo',
            'remember_token' => 'xxx',
        ];

        $this->user = new class($this->attributes) extends GenericUser {
            use NoRememberTokenAuthenticatable;

            public function getKeyName()
            {
                return 'id';
            }

            public function getAttribute(string $key)
            {
                return $this->attributes[$key];
            }
        };

        $this->strict = new class($this->attributes) extends GenericUser {
            use StrictNoRememberTokenAuthenticatable;

            public function getKeyName()
            {
                return 'id';
            }

            public function getAttribute(string $key)
            {
                return $this->attributes[$key];
            }
        };
    }

    public function testGetAuthIdentifierName(): void
    {
        $this->assertSame('id', $this->user->getAuthIdentifierName());
        $this->assertSame('id', $this->strict->getAuthIdentifierName());
    }

    public function testGetAuthIdentifier(): void
    {
        $this->assertSame(123, $this->user->getAuthIdentifier());
        $this->assertSame(123, $this->strict->getAuthIdentifier());
    }

    public function testGetAuthPassword(): void
    {
        $this->assertSame('foo', $this->user->getAuthPassword());
        $this->assertSame('foo', $this->strict->getAuthPassword());
    }

    public function testGetRememberToken(): void
    {
        $this->assertSame('', $this->user->getRememberToken());

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Not implemented');
        $this->strict->getRememberToken();
    }

    public function testSetRememberToken(): void
    {
        $this->user->setRememberToken('yyy');
        $this->assertSame('xxx', $this->user->remember_token);

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Not implemented');
        $this->strict->setRememberToken('yyy');
    }

    public function testGetRememberTokenName(): void
    {
        $this->assertSame('', $this->user->getRememberTokenName());

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Not implemented');
        $this->strict->getRememberTokenName();
    }
}
