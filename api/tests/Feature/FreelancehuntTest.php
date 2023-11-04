<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\FreelancehuntService;

class FreelancehuntTest extends TestCase
{

    public function test_example(): void
    {
        $service = new FreelancehuntService();
        $response = $service->index();

        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertArrayHasKey('data', $response->json());
        $this->assertArrayHasKey('links', $response->json());
    }
}
