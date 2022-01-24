<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{

    private $timestamp;

    public function __construct()
    {
        $this->timestamp = Carbon::now()->timestamp;
    }

    protected function createToken(User $user)
    {
        return auth()
            ->setTTL(config('jwt.ttl'))
            ->claims([
                'iat' => $this->timestamp
            ])
            ->login($user);
    }
}
