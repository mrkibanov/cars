<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait JsonResponse
{
    /**
     * Success response method.
     *
     * @param string|array $data
     * @param int $statusCode
     * @param null $cookie
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($data, $statusCode = 200, $cookie = null)
    {
        $response = is_string($data) ? ['message' => $data] : $data;

        return !is_null($cookie)
            ? response()->json($response, $statusCode)->withCookie($cookie)
            : response()->json($response, $statusCode);
    }

    /**
     * Error response method.
     *
     * @param $error
     * @param array $errorMessages
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error, $statusCode = 401, $errorMessages = [])
    {
        $response = ['message' => $error];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * 401 Unauthorized error response method.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendUnauthorizedError()
    {
        return $this->sendError('Unauthorized. If error persists, please contact us at cars@gmail.com');
    }

    /**
     * 403 Forbidden error response method.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendForbiddenError()
    {
        return $this->sendError('Forbidden. If error persists, please contact us at cars@gmail.com', Response::HTTP_FORBIDDEN);
    }
}
