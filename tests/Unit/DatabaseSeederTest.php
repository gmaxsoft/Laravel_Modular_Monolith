<?php

namespace Tests\Unit;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Modules\UserManagement\Models\User;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_creates_demo_user(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseHas('users', [
            'email' => 'demo@example.com',
            'name' => 'Demo User',
        ]);
    }

    public function test_demo_user_has_correct_password(): void
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::where('email', 'demo@example.com')->first();

        $this->assertNotNull($user);
        $this->assertTrue(Hash::check('demo123', $user->password));
    }

    public function test_seeder_can_be_run_multiple_times_without_duplicates(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $count = User::where('email', 'demo@example.com')->count();

        $this->assertEquals(1, $count);
    }

    public function test_demo_user_has_email_verified_at_set(): void
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::where('email', 'demo@example.com')->first();

        $this->assertNotNull($user->email_verified_at);
    }
}