<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    public function test_products_route_return_ok()
    {
        $response = $this->get('/products');

        $response->assertSee('Products');

        $response->assertStatus(200);
    }

    public function test_products_has_name()
    {
        $product =  Product::factory()->create();
        $this->assertNotEmpty($product->name);
    }

    public function test_products_are_not_empty()
    {
        $product =  Product::factory()->create();
        $response = $this->get('/products');

        $response->assertSee($product->name);
    }

    public function test_auth_admin_user_can_see_create_make_product_link()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get('/products');
        $response->assertSee('Create Product');
    }

    public function test_unauth_admin_user_cannot_see_create_make_product_link()
    {
        $response = $this->get('/products');
        $response->assertDontSee('Create Product');
    }

    public function test_auth_admin_user_can_visit_create_route_return_ok()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get('product/create'); //actingAs => auth check
        $response->assertStatus(200);
    }

    public function test_unauth_user_cannot_visit_create_route_return_ok()
    {
        $response = $this->get('product/create');

        $response->assertStatus(403); //status 302 = not login
    }
}
