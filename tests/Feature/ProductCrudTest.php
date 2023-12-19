<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;
    public function test_admin_can_store_new_product(): void
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->post('/product/create', [
            'name' => 'Computer',
            'type' => 'Software',
            'price' => 20000
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/products');

        $this->assertCount(1, Product::all());
        $this->assertDatabaseHas('products', ['name' => 'Computer', 'type' => 'Software', 'price' => 20000]);
    }

    public function test_admin_can_product_edit_page()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $product = Product::factory()->create();

        $response = $this->actingAs($admin)->get('product/edit/' . $product->id);
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_admin_can_product_update()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        Product::factory()->create();
        $this->assertCount(1, Product::all());

        $product = Product::first();
        $response = $this->actingAs($admin)->put('product/edit' . $product->id, [
            'name' => $product->name,
            'type' => 'Computer',
            'price' => 399
        ]);
        $response->assertSessionHasNoErrors();
        $this->assertEquals($product->name, Product::first()->name);
    }

    public function test_admin_can_product_destroy()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        Product::factory()->create();
        $this->assertCount(1,Product::all());

        $product = Product::first();
        $response = $this->actingAs($admin)->delete('product/delete/'.$product->id);
        $response->assertSessionHasNoErrors();
        $this->assertEquals($product->name, Product::first()->name);
    }
}
