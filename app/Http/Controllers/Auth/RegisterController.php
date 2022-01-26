<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends AuthController
{

    /**
     * @OA\Post(
     *     path="/auth/register",
     *     summary="Sign up",
     *     description="User Registration",
     *     operationId="authRegister",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *        required=true,
     *        description="Pass user credentials",
     *        @OA\JsonContent(
     *           required={"name", "email","password"},
     *           @OA\Property(property="name", type="string", format="string", example="Tom Sawyer"),
     *           @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *           @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *        ),
     *     ),
     *     @OA\Response(
     *        response=422,
     *        description="Unprocessable Content.",
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
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        return $this->sendResponse(
            ['token' => $this->createToken($user)]
        );
    }
}
