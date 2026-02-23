<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcessResetPasswordRequest; // Подключили реквест
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class ProcessResetPasswordController extends Controller
{
    public function __construct(private AuthService $service)
    {
    }
    public function __invoke(ProcessResetPasswordRequest $request): RedirectResponse
    {
        $status = $this->service->resetPassword(
            $request->only('email', 'password', 'password_confirmation', 'token')
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        return back()->withErrors(['email' => [__($status)]]);
    }
}
