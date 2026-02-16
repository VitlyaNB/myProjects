<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Interest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InterestTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_their_interests_index(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $interest = Interest::factory()->create([
            'user_id' => $user->id,
            'name' => 'Программирование'
        ]);

        $response = $this->actingAs($user)->get(route('interests.index'));

        $response->assertStatus(200);
        $response->assertSee('Программирование');
    }


    public function test_user_can_store_new_interest(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('interests.store'), [
            'name' => 'Путешествия'
        ]);

        $response->assertJson(['success' => true]);
        $this->assertDatabaseHas('interests', [
            'name' => 'Путешествия',
            'user_id' => $user->id
        ]);
    }

    public function test_user_cannot_update_others_interest(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $interest = Interest::factory()->create(['user_id' => $user1->id]);

        $response = $this->actingAs($user2)->put(route('interests.update', $interest), [
            'name' => 'Взломанное имя'
        ]);

        $response->assertStatus(403);
    }


    public function test_user_can_get_stats(): void
    {
        $user = User::factory()->create();
        Interest::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('interests.stats'));

        $response->assertStatus(200)
            ->assertJsonStructure(['total', 'today', 'month']);
    }
}
