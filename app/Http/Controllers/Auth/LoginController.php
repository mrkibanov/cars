<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends AuthController
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (is_null($user)) {
            return $this->sendUnauthorizedError();
        }

        if (Hash::check($request->input('password'), $user->getAuthPassword())) {

            return $this->sendResponse(
                ['token' => $this->createToken($user)]
            );
        }

        return $this->sendUnauthorizedError();
    }
}
