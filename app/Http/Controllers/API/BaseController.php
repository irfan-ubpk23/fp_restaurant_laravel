<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result, $message="Success")
    {
        $response = [
            'success'   => true,
            'data'      => $result,
            'message'   => $message
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages=[], $code=404)
    {
        $response = [
            'success'   => false,
            'message'   => $error
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
