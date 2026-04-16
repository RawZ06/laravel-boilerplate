<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_access_admin_section(): void
    {
        $user = User::factory()->create([
            'role' => UserRole::USER,
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_section(): void
    {
        $admin = User::factory()->create([
            'role' => UserRole::ADMIN,
        ]);

        // Note: we assume /admin exists and returns something successful if authorized
        // or at least not a 403.
        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
    }

    public function test_guest_cannot_access_admin_section(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }

    public function test_admin_can_create_user_with_role(): void
    {
        $admin = User::factory()->create([
            'role' => UserRole::ADMIN,
        ]);

        $response = $this->actingAs($admin)->post(route('backend.users.store'), [
            'name' => 'New User',
            'email' => 'new@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => UserRole::ADMIN->value,
        ]);

        $response->assertRedirect(route('backend.users.index'));
        $this->assertDatabaseHas('users', [
            'email' => 'new@example.com',
            'role' => UserRole::ADMIN->value,
        ]);
    }

    public function test_admin_can_update_user_role(): void
    {
        $admin = User::factory()->create([
            'role' => UserRole::ADMIN,
        ]);
        $user = User::factory()->create([
            'role' => UserRole::USER,
        ]);

        $response = $this->actingAs($admin)->put(route('backend.users.update', $user), [
            'name' => $user->name,
            'email' => $user->email,
            'role' => UserRole::ADMIN->value,
        ]);

        $response->assertRedirect(route('backend.users.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'role' => UserRole::ADMIN->value,
        ]);
    }

    public function test_admin_can_see_user_role_in_show_view(): void
    {
        $admin = User::factory()->create([
            'role' => UserRole::ADMIN,
        ]);
        $user = User::factory()->create([
            'role' => UserRole::USER,
        ]);

        $response = $this->actingAs($admin)->get(route('backend.users.show', $user));

        $response->assertStatus(200);
        $response->assertSee('Role');
        $response->assertSee($user->role->label());
    }

    public function test_admin_can_view_user_edit_page(): void
    {
        $admin = User::factory()->create(['role' => UserRole::ADMIN]);
        $user = User::factory()->create();

        $response = $this->actingAs($admin)->get(route('backend.users.edit', $user));

        $response->assertStatus(200);
        $response->assertSee($user->name);
    }

    public function test_admin_can_delete_user(): void
    {
        $admin = User::factory()->create(['role' => UserRole::ADMIN]);
        $user = User::factory()->create();

        $response = $this->actingAs($admin)->delete(route('backend.users.destroy', $user));

        $response->assertRedirect(route('backend.users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_admin_can_view_user_create_page(): void
    {
        $admin = User::factory()->create(['role' => UserRole::ADMIN]);

        $response = $this->actingAs($admin)->get(route('backend.users.create'));

        $response->assertStatus(200);
    }
}
