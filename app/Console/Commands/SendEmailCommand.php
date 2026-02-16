<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class SendEmailCommand extends Command
{

    protected $signature = 'user:send-welcome {user}';


    protected $description = 'Отправить приветственное письмо пользователю по его ID';


    public function handle(): int
    {
        $userId = $this->argument('user');
        $user = User::find($userId);

        if (!$user) {
            $this->error("Пользователь с ID {$userId} не найден!");
            return Command::FAILURE;
        }

        $this->info("Отправка письма пользователю: {$user->email}...");

        try {
            // Используем в Mailable
            Mail::to($user->email)->send(new WelcomeEmail($user));

            $this->info("Письмо успешно отправлено!");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Ошибка при отправке: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
