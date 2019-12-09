<?php

namespace Mpyw\NullAuth\Tests\Unit;

use Illuminate\Auth\GenericUser;
use LogicException;
use Mpyw\NullAuth\NullAuthenticatable;
use Mpyw\NullAuth\StrictNullAuthenticatable;
use Mpyw\NullAuth\Tests\TestCase;

class NullAuthenticatableTest extends TestCase
{
    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var \Illuminate\Auth\GenericUser|\Mpyw\NullAuth\NullAuthenticatable
     */
    protected $user;

    /**
     * @var \Illuminate\Auth\GenericUser|\Mpyw\NullAuth\StrictNullAuthenticatable
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
            use NullAuthenticatable;
        };

        $this->strict = new class($this->attributes) extends GenericUser {
            use StrictNullAuthenticatable;
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
        $this->assertSame('', $this->user->getAuthPassword());

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Not implemented');
        $this->strict->getAuthPassword();
    }

    public function testGetRememberToken(): void
    {
        $this->assertSame('', $this->user->getRememberToken());

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Not implemented');
        $this->strict->getRememberToken();
    }

    public function testSetRememberToken(): void
    {
        $this->user->setRememberToken('yyy');
        $this->assertSame('xxx', $this->user->remember_token);

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Not implemented');
        $this->strict->setRememberToken('yyy');
    }

    public function testGetRememberTokenName(): void
    {
        $this->assertSame('', $this->user->getRememberTokenName());

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Not implemented');
        $this->strict->getRememberTokenName();
    }
}
