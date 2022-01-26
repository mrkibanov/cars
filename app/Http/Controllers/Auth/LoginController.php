<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends AuthController
{

    /**
     * @OA\Post(
     *     path="/auth",
     *     summary="Sign in",
     *     description="Login by email, password",
     *     operationId="authLogin",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *        required=true,
     *        description="Pass user credentials",
     *        @OA\JsonContent(
     *           required={"email","password"},
     *           @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *           @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *        ),
     *     ),
     *     @OA\Response(
     *        response=401,
     *        description="Unauthorized.",
     *     ),
     *     @OA\Response(
     *        response=422,
     *        description="Unprocessable entity.",
     *     ),
     *     @OA\Response(
     *        response=200,
     *        description="Success",
     *        @OA\JsonContent(
     *           @OA\Property(property="token", type="object", ref="#/components/schemas/Token"),
     *        ),
     *      ),
     *  ),
     */
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
