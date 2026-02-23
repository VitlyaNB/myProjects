<?php

namespace Tests\Feature;

use App\Models\Interest;
use App\Models\User;
use App\Repositories\InterestRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InterestRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_calculates_correct_stats_for_user(): void
    {
        $user = User::factory()->create();
        $repo = new InterestRepository();

        Interest::factory()->create(['user_id' => $user->id, 'created_at' => now()]);
        Interest::factory()->create(['user_id' => $user->id, 'created_at' => now()->subDay()]);
        Interest::factory()->create(['user_id' => $user->id, 'created_at' => now()->subMonth()]);

        $stats = $repo->getStatsForUser($user->id);

        $this->assertEquals(3, $stats['total']);
        $this->assertEquals(1, $stats['today']);
        $this->assertEquals(2, $stats['month']);
    }
}
