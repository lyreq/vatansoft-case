<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SMSIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_sms_list(): void
    {

        $response = $this->get('/api/sms', $this->header);


        $response->assertStatus(200);
    }
}
