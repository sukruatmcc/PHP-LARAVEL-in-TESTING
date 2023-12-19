<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_login_redirect_dashboard_successfully(): void
    {
        User::factory()->create([
            'name' => 'sukru',
            'email' => 'sukru38@gmail.com',
            'password' => Hash::make('password')
        ]);

        $response = $this->post('/login',[
            'name' => 'sukru',
            'email' => 'sukru38@gmail.com',
            'password' => 'password'
       ]);

       $response->assertStatus(302);
       $response->assertRedirect('/dashboard');
    }

    public function test_auth_user_can_access_dashboard()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_unauth_user_can_access_dashboard()
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

}
