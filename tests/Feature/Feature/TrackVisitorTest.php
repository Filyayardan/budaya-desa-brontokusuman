<?php

namespace Tests\Feature;

use App\Models\Visitor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrackVisitorTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_request_records_visitor(): void
    {
        $this->withHeaders([
            'User-Agent' => 'Testing Browser',
        ])->get('/kontak');

        $this->assertDatabaseHas('visitors', [
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Testing Browser',
        ]);

        $this->assertDatabaseCount('visitors', 1);
    }

    public function test_admin_request_does_not_record_visitor(): void
    {
        $this->get('/admin/login');

        $this->assertDatabaseCount('visitors', 0);
    }

    public function test_recorded_session_does_not_create_another_visitor(): void
    {
        $this->withSession([
            'visitor_recorded' => true,
        ])->get('/kontak');

        $this->assertDatabaseCount('visitors', 0);
    }
}
