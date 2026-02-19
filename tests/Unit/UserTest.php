<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\UserManagement\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_correct_fillable_attributes(): void
    {
        $user = new User;

        $this->assertEquals(['name', 'email', 'password'], $user->getFillable());
    }

    public function test_user_has_correct_hidden_attributes(): void
    {
        $user = new User;

        $this->assertContains('password', $user->getHidden());
        $this->assertContains('remember_token', $user->getHidden());
    }

    public function test_password_is_hashed_when_set(): void
    {
        $user = User::factory()->create([
            'password' => 'plaintext',
        ]);

        $this->assertNotEquals('plaintext', $user->password);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('plaintext', $user->password));
    }

    public function test_user_has_email_verified_at_cast(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $user->email_verified_at);
    }

    public function test_factory_creates_valid_user(): void
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
        $this->assertNotNull($user->name);
        $this->assertNotNull($user->email);
        $this->assertNotNull($user->password);
    }

    public function test_unverified_state_sets_email_verified_at_to_null(): void
    {
        $user = User::factory()->unverified()->create();

        $this->assertNull($user->email_verified_at);
    }

    public function test_user_can_be_authenticated(): void
    {
        $user = User::factory()->create([
            'password' => 'password',
        ]);

        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('password', $user->password));
    }
}
