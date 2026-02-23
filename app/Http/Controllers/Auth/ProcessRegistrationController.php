<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;

class ProcessRegistrationController extends Controller
{
    public function __construct(
        private AuthService $service
    ) {
    }

    public function __invoke(RegisterRequest $request): RedirectResponse
    {
        $this->service->register($request->validated());

        return redirect()->route('interests.index');
    }
}
