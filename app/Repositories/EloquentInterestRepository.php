<?php


namespace App\Repositories;

use App\Models\Interest;
use App\Repositories\Contracts\InterestRepositoryInterface;
use App\DTO\InterestDTO;
use Illuminate\Database\Eloquent\Collection;

class EloquentInterestRepository implements InterestRepositoryInterface
{
    public function getAllForUser(int $userId): Collection
    {
        return Interest::where('user_id', $userId)->recent()->get();
    }

    public function create(InterestDTO $data): Interest
    {
        return Interest::create([
            'name' => $data->name,
            'user_id' => $data->userId
        ]);
    }

    public function update(Interest $interest, InterestDTO $data): bool
    {
        return $interest->update(['name' => $data->name]);
    }

    public function delete(Interest $interest): bool
    {
        return $interest->delete();
    }

    public function getStatsForUser(int $userId): array
    {
        $query = Interest::where('user_id', $userId);

        return [
            'total' => (clone $query)->count(),
            'today' => (clone $query)->whereDate('created_at', today())->count(),
            'month' => (clone $query)->where('created_at', '>=', now()->startOfMonth())->count(),
        ];
    }
}
