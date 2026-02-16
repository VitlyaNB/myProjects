<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Interest;
use App\Repositories\EloquentInterestRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InterestRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_calculates_correct_stats_for_user(): void
    {
        $user = User::factory()->create();
        $repo = new EloquentInterestRepository();

        // 1 интерес сегодня
        Interest::factory()->create(['user_id' => $user->id, 'created_at' => now()]);

        // 1 интерес вчера (но в этом месяце)
        Interest::factory()->create(['user_id' => $user->id, 'created_at' => now()->subDay()]);

        // 1 интерес в прошлом месяце
        Interest::factory()->create(['user_id' => $user->id, 'created_at' => now()->subMonth()]);

        $stats = $repo->getStatsForUser($user->id);

        $this->assertEquals(3, $stats['total']);
        $this->assertEquals(1, $stats['today']);
        $this->assertEquals(2, $stats['month']);
    }
}
