<?php


namespace App\Services;

use App\DTO\InterestDTO;
use App\Models\Interest;
use App\Repositories\Contracts\InterestRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

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
        return $this->repository->update($interest, $data);
    }

    public function deleteInterest(Interest $interest): bool
    {
        return $this->repository->delete($interest);
    }

    public function getStats(): array
    {
        return $this->repository->getStatsForUser(Auth::id());
    }
}
