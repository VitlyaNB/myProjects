<?php

namespace App\Services;

use App\Jobs\SendWelcomeEmailJob;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct(
        private UserRepositoryInterface $repository
    ) {
    }

    public function loginWeb(array $credentials, bool $remember): User
    {
        if (!Auth::attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }

        return Auth::user();
    }

    public function loginApi(array $credentials): array
    {
        $user = $this->repository->findByEmail($credentials['email']);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Неверные учетные данные.'],
            ]);
        }

        $token = $user->createToken('api')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function register(array $data): User
    {
        $user = $this->repository->create($data);

        SendWelcomeEmailJob::dispatch($user->email, $user->name);

        Auth::login($user);

        return $user;
    }

    public function resetPassword(array $data): string
    {
        return Password::broker()->reset(
            $data,
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
                event(new PasswordReset($user));
            }
        );
    }
}
