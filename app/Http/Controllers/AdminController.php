<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware уже проверяет роль, но на всякий случай
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        // БЫЛО: User::where('role', '!=', 'admin')->withCount('interests')->get();
        // СТАЛО: (используем наш scope)
        $users = User::regularUsers()->withCount('interests')->get();

        return view('admin.index', compact('users'));
    }

    public function showUserInterests(User $user)
    {
        // Проверка: не даем смотреть интересы другого админа
        if ($user->role === 'admin') {
            abort(403, 'Cannot view admin interests');
        }

        // Используем scopeRecent() из модели Interest
        $interests = $user->interests()->recent()->get();

        return view('admin.user-interests', compact('user', 'interests'));
    }
}
