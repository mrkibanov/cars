<?php

namespace App\Http\Controllers;

use App\Traits\JsonResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Cars API Documentation",
     *      description="Better understanding for FREE job API",
     *      @OA\Contact(
     *          email="admin@admin.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Cars API Server"
     * )
     *
     *
     * @OA\Tag(
     *     name="Cars app",
     *     description="API Endpoints of Projects"
     * )
     *
     *
     * @OA\SecurityScheme(
     *     type="http",
     *     description="Login with email and password to get the authentication token",
     *     name="Token based Based",
     *     in="header",
     *     scheme="bearer",
     *     bearerFormat="JWT",
     *     securityScheme="apiAuth",
     * )
     */

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, JsonResponse;
}
