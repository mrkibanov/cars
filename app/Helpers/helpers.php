<?php

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

if (!function_exists('getTestingAuthHeader')) {
    function getTestingAuthHeader(): array
    {
        $user = User::updateOrCreate([
                'email' => config('app.admin.email'),
            ], [
                'name' => config('app.admin.name'),
                'password' => bcrypt(config('app.admin.password'))
            ]
        );

        $token = JWTAuth::fromUser($user);

        return ['Authorization' => 'Bearer ' . $token];
    }
}
