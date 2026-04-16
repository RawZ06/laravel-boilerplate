<?php

namespace Tests\Feature;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuditTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_a_user_creates_an_audit_log(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $this->assertDatabaseHas('audits', [
            'event' => 'created',
            'auditable_type' => User::class,
            'auditable_id' => $user->id,
        ]);

        $audit = Audit::where('event', 'created')
            ->where('auditable_id', $user->id)
            ->first();

        $this->assertNotNull($audit);
        // Verify that the new values contain the email
        $this->assertEquals('john@example.com', $audit->new_values['email']);
    }

    public function test_updating_a_user_creates_an_audit_log_with_changes(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
        ]);

        $user->update([
            'name' => 'Jane Doe',
        ]);

        $this->assertDatabaseHas('audits', [
            'event' => 'updated',
            'auditable_type' => User::class,
            'auditable_id' => $user->id,
        ]);

        $audit = Audit::where('event', 'updated')
            ->where('auditable_id', $user->id)
            ->first();

        $this->assertEquals('John Doe', $audit->old_values['name']);
        $this->assertEquals('Jane Doe', $audit->new_values['name']);
    }

    public function test_deleting_a_user_creates_an_audit_log(): void
    {
        $user = User::factory()->create();
        $userId = $user->id;

        $user->delete();

        $this->assertDatabaseHas('audits', [
            'event' => 'deleted',
            'auditable_type' => User::class,
            'auditable_id' => $userId,
        ]);
    }

    public function test_audit_logs_user_id_if_authenticated(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $user = User::factory()->create();

        $audit = Audit::where('event', 'created')
            ->where('auditable_id', $user->id)
            ->first();

        $this->assertEquals($admin->id, $audit->user_id);
    }

    public function test_admin_can_access_audit_index(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->get(route('backend.audits.index'));

        $response->assertStatus(200);
        $response->assertSee('Audit Logs');
    }

    public function test_admin_can_view_audit_details(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $user = User::factory()->create(['name' => 'Old Name']);
        $user->update(['name' => 'New Name']);

        $audit = Audit::where('event', 'updated')->first();

        $response = $this->get(route('backend.audits.show', $audit->id));

        $response->assertStatus(200);
        $response->assertSee('Audit Details');
        $response->assertSee('Old Name');
        $response->assertSee('New Name');
        $response->assertSee(route('backend.users.show', $user->id));
    }

    public function test_non_admin_cannot_access_audits(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $response = $this->get(route('backend.audits.index'));

        // Depending on the 'admin' middleware implementation, this can be 403 or redirect.
        // We assume here it blocks access.
        $response->assertStatus(403);
    }

    public function test_audit_index_shows_resource_link_when_not_deleted(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $user = User::factory()->create(['name' => 'Test User']);

        $response = $this->get(route('backend.audits.index'));

        $response->assertStatus(200);
        $response->assertSee(route('backend.users.show', $user->id));
    }

    public function test_audit_index_does_not_show_resource_link_when_deleted(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $user = User::factory()->create();
        $userId = $user->id;
        $user->delete();

        $response = $this->get(route('backend.audits.index'));

        $response->assertStatus(200);
        // Verify that the link to the deleted user is not present for the deleted event
        // Note: the ID itself will be present, but not wrapped in an <a> tag with the route
        $response->assertDontSee('href="'.route('backend.users.show', $userId).'"');
    }

    public function test_audit_ignores_non_auditable_fields(): void
    {
        $user = User::factory()->create();
        $auditCountBefore = Audit::count();

        $user->update([
            'remember_token' => 'new-token',
        ]);

        $this->assertEquals($auditCountBefore, Audit::count());
    }

    public function test_audit_hides_sensitive_fields(): void
    {
        $user = User::factory()->create(['password' => 'old-password']);

        $user->update([
            'password' => 'new-password',
            'name' => 'New Name', // We also change the name to trigger the audit (since password might be ignored if it's the only thing changing? no, here password is not in unauditableAttributes)
        ]);

        $audit = Audit::where('event', 'updated')
            ->where('auditable_id', $user->id)
            ->first();

        $this->assertNotNull($audit);
        $this->assertEquals('[HIDDEN]', $audit->old_values['password']);
        $this->assertEquals('[HIDDEN]', $audit->new_values['password']);
        $this->assertEquals('New Name', $audit->new_values['name']);
    }
}
