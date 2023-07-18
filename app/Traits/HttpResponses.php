<?php

namespace App\Traits;

trait HttpResponses {
    protected function success($data, $message = null, $code = 200) {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'code' => $code
        ], $code);
    }

    protected function error($data, $message = null, $code) {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'code' => $code
        ], $code);
    }
}