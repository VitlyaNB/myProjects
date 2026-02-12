<?php


namespace App\Http\Controllers\Interests;

use App\Http\Controllers\Controller;
use App\Services\InterestService;
use App\Models\Interest;
use Illuminate\Http\JsonResponse;

class DestroyController extends Controller
{
    public function __construct(protected InterestService $service)
    {
    }

    public function __invoke(Interest $interest): JsonResponse
    {
        $this->service->deleteInterest($interest);
        return response()->json(['success' => true]);
    }
}
