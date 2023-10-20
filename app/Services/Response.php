<?php

namespace App\Services;

class Response
{
    const SUCCESS = 'success';
    const FAIL = 'error';

    public static function notFoundError($message = 'Not Found', $statusCode = 404, $data = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($data) $response['data'] = $data;

        return response()->json($response, $statusCode);
    }

    public static function badRequestError($message = 'Bad Request', $statusCode = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }

    public static function unauthorizedError($message = 'Unauthorized', $statusCode = 401)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }

    public static function forbiddenError($message = 'This action disallowed', $statusCode = 403)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }

    public static function conflictError($message = 'Data already exist', $statusCode = 409)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }

    public static function tooManyRequestsError($message = 'Too many request', $statusCode = 429)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }

    public static function internalServerError($error = 'Internal Server Error', $message = 'Internal Server Error', $statusCode = 500)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => $error
        ], $statusCode);
    }

    public static function success($message = 'Request Success', $data = null, $statusCode = 200)
    {
        $response['success'] = true;
        $response['message'] = $message;
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response, $statusCode);
    }
}
