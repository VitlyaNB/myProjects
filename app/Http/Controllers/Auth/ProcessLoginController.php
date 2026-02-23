<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;

class ProcessLoginController extends Controller
{
    public function __construct(private AuthService $service)
    {
    }

    public function __invoke(LoginRequest $request): RedirectResponse
    {
        $user = $this->service->loginWeb($request->only('email', 'password'), $request->boolean('remember'));

        $request->session()->regenerate();

        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.index'));
        }

        return redirect()->intended(route('interests.index'));
    }
}
