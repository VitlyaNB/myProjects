<?php

namespace App\Http\Controllers\Interests;

use App\DTO\InterestDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Interest\UpdateInterestRequest;
use App\Models\Interest;
use App\Services\InterestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function __construct(private InterestService $service)
    {
    }

    public function __invoke(UpdateInterestRequest $request, Interest $interest): JsonResponse
    {
        if ($interest->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $dto = InterestDTO::fromRequest($request);
        $this->service->updateInterest($interest, $dto);

        return response()->json();
    }
}
