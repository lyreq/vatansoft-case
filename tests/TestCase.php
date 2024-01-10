<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    protected $header = array();

    protected function setUp(): void
    {
        parent::setUp();
        $data = [
            "email" => "info@vatansoft.com",
            "password" => "password"
        ];
        $response = $this->post('/api/auth/login', $data);
        $token = $response->json()['data']['token_type'] . " " . $response->json()['data']['access_token'];

        $this->header = [
            'Authorization' => $token
        ];
    }
}
