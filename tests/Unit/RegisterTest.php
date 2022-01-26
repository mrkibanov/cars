<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Basic login.
     *
     * @return void
     */
    public function test_register_success()
    {
        $user = [
            'name' => 'testName',
            'email' => 'myeamil@gmail.com',
            'password' => 'password'
        ];
        $response = $this->post(route('register'), $user);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'token'
            ]);
    }

    /**
     * Empty params login.
     *
     * @return void
     */
    public function test_register_fail()
    {
        $user = [
            'email' => 'admin@admin.com',
            'password' => '123123'
        ];
        $response = $this->post(route('register'), $user);

        $response->assertUnprocessable();
    }
}
