<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\UserManagement\Models\User;
use Tests\TestCase;

class UserFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_user_with_required_attributes(): void
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', ['id' => $user->id]);
        $this->assertNotEmpty($user->name);
        $this->assertNotEmpty($user->email);
        $this->assertNotEmpty($user->password);
    }

    public function test_factory_creates_unique_emails(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $this->assertNotEquals($user1->email, $user2->email);
    }

    public function test_factory_accepts_overrides(): void
    {
        $user = User::factory()->create([
            'name' => 'Custom Name',
            'email' => 'custom@example.com',
        ]);

        $this->assertEquals('Custom Name', $user->name);
        $this->assertEquals('custom@example.com', $user->email);
    }

    public function test_unverified_state_removes_email_verified_at(): void
    {
        $user = User::factory()->unverified()->create();

        $this->assertNull($user->email_verified_at);
    }

    public function test_default_state_has_email_verified_at(): void
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->email_verified_at);
    }
}
