<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse($response, $message)
    {
        return response()->json([
            'status' => true,
            'data' => $response,
            'message' => $message,
        ]);
    }
    public function sendError($message)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ]);
    }
    public function sendSuccess($message)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }
}
