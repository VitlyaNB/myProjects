<?php

namespace App\Repositories\Contracts;

use App\DTO\InterestDTO;
use App\Models\Interest;
use Illuminate\Database\Eloquent\Collection;

interface InterestRepositoryInterface
{
    public function getAllForUser(int $userId): Collection;
    public function create(InterestDTO $data): Interest;
    public function update(Interest $interest, InterestDTO $data): bool;
    public function delete(Interest $interest): bool;
    public function getStatsForUser(int $userId): array;
}
