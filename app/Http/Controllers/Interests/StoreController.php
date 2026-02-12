<?php


namespace App\Http\Controllers\Interests;

use App\DTO\InterestDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Interest\StoreInterestRequest;
use App\Services\InterestService;
use App\Http\Resources\InterestResource;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function __construct(protected InterestService $service)
    {
    }

    public function __invoke(StoreInterestRequest $request): JsonResponse
    {
        $dto = InterestDTO::fromRequest($request);
        $interest = $this->service->createInterest($dto);

        return response()->json([
            'success' => true,
            'interest' => new InterestResource($interest)
        ]);
    }
}
