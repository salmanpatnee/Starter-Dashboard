<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Entry route test.
     *
     * @return void
     */
    public function test_application_entry_route()
    {
        $response = $this->get('/{any}');

        $response->assertOk()
            ->assertViewIs('app');
    }
}
