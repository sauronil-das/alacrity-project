<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * Test creating a new User instance.
     *
     * @return void
     */
    public function test_create_user_instance()
    {
        $user = new User();

        $user->name = 'Test User';
        $user->email = 'test@example.com';

        $this->assertEquals('Test User', $user->name);
        $this->assertEquals('test@example.com', $user->email);
    }
}
