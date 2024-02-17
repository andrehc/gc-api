<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function  test_can_login() {
        // $user = \App\Models\User::factory()->make([
        //     'email' => 'test1@example.com',
        //     'password' => bcrypt('password'),
        // ]);

        $data = [
            'email' => 'test1@example.com',
            'password' => 'password',
        ];
        //api login
        $response = $this->json('POST', '/login', $data);

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }
}
