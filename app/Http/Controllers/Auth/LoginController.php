<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Куда перенаправлять пользователя после входа.
     * Вместо жесткой переменной $redirectTo используем метод.
     */
    protected function redirectTo()
    {
        // Если зашел админ
        if (Auth::user()->role === 'admin') {
            return route('admin.index');
        }

        // Если зашел обычный пользователь
        return route('interests.index');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
