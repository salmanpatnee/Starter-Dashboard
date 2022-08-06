<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A user has fullname.
     * 
     * @test
     * @return void
     */
    public function uer_has_fullname()
    {
        $user = User::factory()->create([
            'name' => 'John',
            'email' => 'john@gmail.com'
        ]);

        $this->assertEquals('John john@gmail.com', $user->fullname);
    }

    /**
     * A basic unit test example.
     * 
     * @test
     * @return void
     */
    public function uer_has_status()
    {
        $user = User::factory()->create();

        $this->assertEquals(1, $user->status);
    }
}
