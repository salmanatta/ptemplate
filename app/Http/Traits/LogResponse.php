<?php

namespace App\Http\Traits;

use Illuminate\Http\Response;
use Twilio\Jwt\JWT;

trait LogResponse
{
    public function response($message = '', $customCode = "0", $data = [], $code = Response::HTTP_OK, $meta = [], $exception = 0)
    {
        return response()->json([
            'code' => $exception == 1 ? "1" : $customCode,
            'msg' => $exception == 1 ? (!app()->isProduction() ? $message : 'Something went wrong') : $message,
            // 'data' => $data === [] ? null : JWT::encode($data, 'he'),
            // 'meta' => $meta === [] ? null : JWT::encode($meta, 'he'),
            'data' => $data === [] ? null : $data,
            'meta' => $meta === [] ? null : $meta
        ], $code);
    }

    public function exception($message = '', $file = '', $line = '', $code = '', $data = [])
    {
        app('log')->error('EXCEPTION : ' . $message, [
            'Line' => $line,
            'File' => $file,
            'Code' => $code,
            'Data' => $data
        ]);
    }

    public function warning($message = '', $file = '', $line = '', $code = '', $data = [])
    {
        app('log')->error('WARNING : ' . $message, [
            'Line' => $line,
            'File' => $file,
            'Code' => $code,
            'Data' => $data
        ]);
    }

    public function info($message = '', $file = '', $line = '', $code = '', $data = [])
    {
        app('log')->error('INFO : ' . $message, [
            'Line' => $line,
            'File' => $file,
            'Code' => $code,
            'Data' => $data
        ]);
    }
}
