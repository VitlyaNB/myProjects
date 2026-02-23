<?php

namespace App\Http\Controllers\Interests;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatsResource;
use App\Services\InterestService;
use Illuminate\Http\JsonResponse;

class StatsController extends Controller
{
    public function __construct(private InterestService $service)
    {
    }

    public function __invoke(): StatsResource
    {
        $stats = $this->service->getStats();

        return new StatsResource($stats);
    }
}
