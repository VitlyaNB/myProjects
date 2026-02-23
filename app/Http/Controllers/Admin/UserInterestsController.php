<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Contracts\InterestRepositoryInterface;
use Illuminate\View\View;

class UserInterestsController extends Controller
{
    public function __construct(
        private InterestRepositoryInterface $repository
    ) {
    }

    public function __invoke(User $user): View
    {
        if ($user->role === 'admin') {
            abort(403, 'Cannot view admin interests');
        }

        $interests = $this->repository->getAllForUser($user->id);

        return view('admin.user-interests', compact('user', 'interests'));
    }
}
