<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function success($data = null)
    {
        $result = [
            'success' => 1,
        ];

        if ($data !== null) {
            $result['data'] = $data;
        }
        
        return response()->json($result);
    }

    protected function error(string $message)
    {
        return response()->json(
            [
                'success' => 0,
                'error'   => $message,
            ]
        );
    }
}
