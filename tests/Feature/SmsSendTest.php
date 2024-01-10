<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SmsSendTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_send_sms(): void
    {
        $data = [
            [
                "number" => "123456789",
                "message" => "123456789"
            ]
        ];
        $response = $this->post('/api/sms/send', $data, $this->header);

        $response->assertStatus(200);
    }
}
