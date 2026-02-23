<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendPasswordResetLinkRequest; // Подключили наш реквест
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class SendPasswordResetLinkController extends Controller
{
    public function __invoke(SendPasswordResetLinkRequest $request): RedirectResponse
    {
        $status = Password::broker()->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
