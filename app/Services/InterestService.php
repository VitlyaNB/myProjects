<?php


namespace App\Services;

use App\Repositories\Contracts\InterestRepositoryInterface;
use App\DTO\InterestDTO;
use App\Models\Interest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class InterestService
{
    public function __construct(
        protected InterestRepositoryInterface $repository
    )
    {
    }

    public function getUserInterests(): Collection
    {
        return $this->repository->getAllForUser(Auth::id());
    }

    public function createInterest(InterestDTO $data): Interest
    {
        return $this->repository->create($data);
    }

    public function updateInterest(Interest $interest, InterestDTO $data): bool
    {
        if ($interest->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return $this->repository->update($interest, $data);
    }

    public function deleteInterest(Interest $interest): bool
    {
        if ($interest->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return $this->repository->delete($interest);
    }

    public function getStats(): array
    {
        return $this->repository->getStatsForUser(Auth::id());
    }
}
