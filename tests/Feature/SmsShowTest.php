<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SmsShowTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_sms_show(): void
    {
        $response = $this->get('/api/sms/1', $this->header);
        $response->assertStatus(200);
    }
}
