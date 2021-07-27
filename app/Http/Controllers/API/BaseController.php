<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    
    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            'message' => null,
        ],
        'data' => null,
    ];

    public static function sendResponseAuth($token, $data = null, $message = null)
    {
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $token;
        self::$response['data']['user'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    public function sendResponse($data = null, $message = null)
    {
    	// $response = [
        //     'success' => true,
        //     'data'    => $result,
        //     'message' => $message,
        // ];

        self::$response['meta']['message'] = $message;
        self::$response['data']['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
        // return response()->json($response, 200);
    }
    public function sendResponseMember($data = null, $message = null)
    {
    	self::$response['meta']['message'] = $message;
        self::$response['data']['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
