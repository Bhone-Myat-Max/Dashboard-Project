<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function success($result, $message, $code = 200)
    {
        $response =[
            'code' => $code,
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->jason($response, $code);
        }

        public function error($error, $errorMessage =[], $code = 500){
            $response =[
                'code' =>$code,
                'success' =>false,
                'message' => $error,

            ];

            if(!empty($errorMesasge)){
                $response['data'] = $errorMesasge;
            }
            return response->jason($response, $code);
        }
    }

