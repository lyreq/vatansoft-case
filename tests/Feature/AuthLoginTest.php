<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_auth_login(): void
    {

        $response = $this->json('POST', '/api/auth/login', [
            'email' => 'info@vatansoft.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200);
    }
}
