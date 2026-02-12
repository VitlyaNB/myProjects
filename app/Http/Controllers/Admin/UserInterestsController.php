<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class UserInterestsController extends Controller
{
    public function __invoke(User $user): View
    {
        if ($user->role === 'admin') {
            abort(403, 'Cannot view admin interests');
        }

        $interests = $user->interests()->recent()->get();

        return view('admin.user-interests', compact('user', 'interests'));
    }
}
