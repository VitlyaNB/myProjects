<?php


namespace Tests\Feature;

use App\Models\User;
use App\Models\Interest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * обычный пользователь не имеет доступа к админке.
     */
    public function test_regular_user_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get(route('admin.index'));

        $response->assertStatus(403);
    }

    /**
     * админ видит список пользователей и статистику.
     */
    public function test_admin_can_view_users_list(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $regularUser = User::factory()->create(['role' => 'user', 'name' => 'Ivan']);

        $response = $this->actingAs($admin)->get(route('admin.index'));

        $response->assertStatus(200);
        $response->assertSee('Ivan');
        $response->assertSee('Панель администратора');
    }

    /**
     просмотр интересов конкретного пользователя админом.
     */
    public function test_admin_can_view_specific_user_interests(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'user']);
        $interest = Interest::factory()->create(['user_id' => $user->id, 'name' => 'Кино']);

        $response = $this->actingAs($admin)->get(route('admin.user.interests', $user));

        $response->assertStatus(200);
        $response->assertSee('Кино');
        $response->assertSee($user->name);
    }
}
