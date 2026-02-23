<?php

namespace App\Http\Controllers\Interests;

use App\DTO\InterestDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Interest\StoreInterestRequest;
use App\Http\Resources\InterestResource;
use App\Services\InterestService;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function __construct(private InterestService $service)
    {
    }

    public function __invoke(StoreInterestRequest $request): JsonResponse
    {
        $dto = InterestDTO::fromRequest($request);
        $interest = $this->service->createInterest($dto);

        return response()->json(new InterestResource($interest), 201);
    }
}
