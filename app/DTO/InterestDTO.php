<?php

namespace App\DTO;

use Illuminate\Http\Request;

readonly class InterestDTO
{
    public function __construct(
        public string $name,
        public ?int $userId = null
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->validated('name'),
            userId: $request->user()?->id
        );
    }
}
