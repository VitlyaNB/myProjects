<?php

namespace App\Http\Controllers\Interests;

use App\Http\Controllers\Controller;
use App\Http\Resources\InterestResource;
use App\Services\InterestService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListController extends Controller
{
    public function __construct(private InterestService $service)
    {
    }

    public function __invoke(): AnonymousResourceCollection
    {
        $interests = $this->service->getUserInterests();

        return InterestResource::collection($interests);
    }
}
