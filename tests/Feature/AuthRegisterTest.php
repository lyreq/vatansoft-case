<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthRegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_auth_register(): void
    {
        $response = $this->json('POST', '/api/auth/register', [
            'name' => 'Test User',
            'email' => 'test' . uniqid() . '@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(200);
    }
}
