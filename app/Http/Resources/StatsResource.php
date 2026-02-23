<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = is_array($this->resource) ? $this->resource : [];

        return [
            'total' => $data['total'] ?? 0,
            'today' => $data['today'] ?? 0,
            'month' => $data['month'] ?? 0,
        ];
    }
}
