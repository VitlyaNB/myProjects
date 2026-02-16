<?php


namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use Tests\TestCase;

class ConsoleWelcomeEmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_console_command_sends_email(): void
    {
        Mail::fake();

        $user = User::factory()->create();

        $this->artisan("user:send-welcome {$user->id}")
            ->expectsOutput("Отправка письма пользователю: {$user->email}...")
            ->assertExitCode(0);

        Mail::assertSent(WelcomeEmail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
