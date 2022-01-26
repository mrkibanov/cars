<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{

    /**
     * Basic login.
     *
     * @return void
     */
    public function test_login_success()
    {
        User::create([
            'name' => config('app.admin.name'),
            'email' => config('app.admin.email'),
            'password' => bcrypt(config('app.admin.password'))
        ]);

        $creds = [
            'email' => config('app.admin.email'),
            'password' => config('app.admin.password')
        ];
        $response = $this->post(route('login'), $creds);

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
    public function test_login_fail()
    {
        $response = $this->post(route('login'), []);

        $response->assertUnprocessable();
    }
}
