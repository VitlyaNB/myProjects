<?php


namespace App\Http\Controllers\Interests;

use App\Http\Controllers\Controller;
use App\Services\InterestService;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __construct(private InterestService $service)
    {
    }

    public function __invoke(): View
    {
        $interests = $this->service->getUserInterests();
        return view('interests.index', compact('interests'));
    }
}
