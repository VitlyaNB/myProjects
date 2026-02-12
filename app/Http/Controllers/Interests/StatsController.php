<?php


namespace App\Http\Controllers\Interests;

use App\Http\Controllers\Controller;
use App\Services\InterestService;
use Illuminate\Http\JsonResponse;

class StatsController extends Controller
{
    public function __construct(protected InterestService $service)
    {
    }

    public function __invoke(): JsonResponse
    {
        $stats = $this->service->getStats();
        return response()->json($stats);
    }
}
