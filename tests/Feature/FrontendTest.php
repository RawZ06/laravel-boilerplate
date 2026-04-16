<?php

namespace Tests\Feature;

use Tests\TestCase;

class FrontendTest extends TestCase
{
    public function test_home_page_is_accessible(): void
    {
        $response = $this->get(route('frontend.home'));
        $response->assertStatus(200);
        $response->assertViewIs('welcome');
    }
}
