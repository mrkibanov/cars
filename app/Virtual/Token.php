<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *     title="Token",
 *     description="JWT Token",
 *     @OA\Xml(
 *         name="Token"
 *     )
 * )
 */
class Token
{

    /**
     * @OA\Property(
     *      title="Token",
     *      description="Token string",
     *      example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvdjFcL2F1dGgiLCJpYXQiOjE2NDMxMTE4NTMsImV4cCI6MTY0MzExNTQ1NCwibmJmIjoxNjQzMTExODU0LCJqdGkiOiI2OVcySjJTUmtvZDR0WU9WIiwic3ViIjo2LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.IwdVcvmWkGKMKx9sTnat7TJWd2GYRC30OZyntjqySpk"
     * )
     *
     * @var string
     */
    public $token;
}
