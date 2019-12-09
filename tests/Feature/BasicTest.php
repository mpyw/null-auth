<?php

namespace Mpyw\NullAuth\Tests\Feature;

use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Auth;
use Mpyw\NullAuth\NullGuard;
use Mpyw\NullAuth\NullUserProvider;
use Mpyw\NullAuth\Tests\TestCase;

class BasicTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        config([
            'auth.guards.web.driver' => 'null',
            'auth.providers.users.driver' => 'null',
        ]);
    }

    public function testGuard(): void
    {
        $this->assertInstanceOf(NullGuard::class, Auth::guard());

        $this->assertFalse(Auth::hasUser());
        $this->assertNull(Auth::user());
        $this->assertFalse(Auth::check());

        Auth::setUser($user = new GenericUser(['id' => 123]));

        $this->assertTrue(Auth::hasUser());
        $this->assertSame($user, Auth::user());
        $this->assertTrue(Auth::check());

        Auth::unsetUser();

        $this->assertFalse(Auth::hasUser());
        $this->assertNull(Auth::user());
        $this->assertFalse(Auth::check());
    }

    public function testProvider(): void
    {
        $this->assertInstanceOf(NullUserProvider::class, Auth::guard()->getProvider());
    }
}
