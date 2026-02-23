<?php

namespace App\Http\Controllers\Interests;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use App\Services\InterestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class DestroyController extends Controller
{
    public function __construct(private InterestService $service)
    {
    }

    public function __invoke(Interest $interest): JsonResponse
    {
        if ($interest->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $this->service->deleteInterest($interest);

        return response()->json();
    }
}
