<?php

namespace Tests\Feature;

use Tests\TestCase;

class DesignSystemTest extends TestCase
{
    public function test_design_system_index_page_is_accessible(): void
    {
        $response = $this->get(route('design-system.index'));
        $response->assertStatus(200);
    }

    public function test_design_system_buttons_page_is_accessible(): void
    {
        $response = $this->get(route('design-system.buttons'));
        $response->assertStatus(200);
    }

    public function test_design_system_form_page_is_accessible(): void
    {
        $response = $this->get(route('design-system.form'));
        $response->assertStatus(200);
    }

    public function test_design_system_table_page_is_accessible(): void
    {
        $response = $this->get(route('design-system.table'));
        $response->assertStatus(200);
    }

    public function test_design_system_feedback_page_is_accessible(): void
    {
        $response = $this->get(route('design-system.feedback'));
        $response->assertStatus(200);
    }

    public function test_design_system_overlay_page_is_accessible(): void
    {
        $response = $this->get(route('design-system.overlay'));
        $response->assertStatus(200);
    }

    public function test_design_system_nav_page_is_accessible(): void
    {
        $response = $this->get(route('design-system.nav'));
        $response->assertStatus(200);
    }
}
