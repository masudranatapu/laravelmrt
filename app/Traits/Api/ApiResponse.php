<?php

namespace App\Traits\Api;

trait ApiResponse
{
    public function successResponse($message = null, $status = 200, $data = null)
    {
        return response()->json([
            'message' => $message,
            'status' => true,
            'data' => $data,
        ], $status);
    }

    public function errorResponse($message = null, $status = 200, $data = null)
    {
        return response()->json([
            'message' => $message,
            'status' => true,
            'data' => $data,
        ], $status);
    }
}
