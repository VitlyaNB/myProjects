<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {

        $users = User::regularUsers()->withCount('interests')->get();

        return view('admin.index', compact('users'));
    }

    public function showUserInterests(User $user)
    {
        if ($user->role === 'admin') {
            abort(403, 'Cannot view admin interests');
        }

        $interests = $user->interests()->recent()->get();

        return view('admin.user-interests', compact('user', 'interests'));
    }
}
