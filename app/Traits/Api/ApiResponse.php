<?php

namespace App\Traits\Api;

trait ApiResponse
{
    public function successResponse($message = null, $data = null)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public function errorResponse($message = null, $data = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data,
        ]);
    }
}
