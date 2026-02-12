<?php


namespace App\Http\Controllers\Interests;

use App\Http\Controllers\Controller;
use App\Services\InterestService;
use App\Http\Resources\InterestResource;
use Illuminate\Http\JsonResponse;

class ListController extends Controller
{
    public function __construct(protected InterestService $service)
    {
    }

    public function __invoke(): JsonResponse
    {
        $interests = $this->service->getUserInterests();

        return response()->json([
            'interests' => InterestResource::collection($interests)
        ]);
    }
}
