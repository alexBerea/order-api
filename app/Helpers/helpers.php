<?php
if (!function_exists('apiResponse')) {
    function apiResponse($statusCode, $payload = null, $message = '')
    {
        return response()->json([
            'statusCode' => $statusCode,
            'payload' => $payload,
            'message' => $message
        ], $statusCode);
    }
}
