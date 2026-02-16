<?php

namespace Tests\Feature;

use App\Jobs\SendWelcomeEmailJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_dispatches_welcome_email_job(): void
    {
        Bus::fake();

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'newuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('interests.index'));
        $this->assertDatabaseHas('users', ['email' => 'newuser@example.com']);

        Bus::assertDispatched(SendWelcomeEmailJob::class);
    }
}
