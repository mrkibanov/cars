<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Store User request",
 *      description="Store User request body data",
 *      type="object",
 *      required={"name"}
 * )
 */

class StoreUserRequest
{

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of User",
     *      example="Tom Sawyer"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Email",
     *      description="User's Email",
     *      example="admin@admin.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="User's password",
     *      example="password123"
     * )
     *
     * @var string
     */
    public $password;
}
