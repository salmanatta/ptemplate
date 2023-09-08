<?php

namespace App\Http\Controllers;

use App\Http\Traits\LogResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, LogResponse;

    public function getMRN(Request $request, $mrn)
    {
        $ch = curl_init("http://10.10.10.222/get-mrn.php?mrn=".$mrn);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        $data = json_decode(json_encode($data),true);
        return (json_decode($data,true));
    }
}
