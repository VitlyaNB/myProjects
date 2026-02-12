<?php


namespace App\Http\Controllers\Interests;

use App\Http\Controllers\Controller;
use App\Http\Requests\Interest\UpdateInterestRequest;
use App\Services\InterestService;
use App\DTO\InterestDTO;
use App\Models\Interest;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    public function __construct(protected InterestService $service)
    {
    }

    public function __invoke(UpdateInterestRequest $request, Interest $interest): JsonResponse
    {
        $dto = InterestDTO::fromRequest($request);
        $this->service->updateInterest($interest, $dto);

        return response()->json(['success' => true]);
    }
}
