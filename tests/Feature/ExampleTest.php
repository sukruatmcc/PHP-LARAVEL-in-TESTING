<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertSeeTextInOrder(['Documentation','Laracast']);

        $response->assertStatus(200);
    }

    public function test_the_about_route_returns_a_successful_response(): void
    {
        $response = $this->get('/about');

        $response->assertSee('about');

        $response->assertStatus(200);
    }
}