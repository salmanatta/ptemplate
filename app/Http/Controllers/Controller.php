<?php

namespace App\Http\Controllers;

use App\Http\Traits\LogResponse;
use App\Models\Patient;
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
        $data = json_decode($data,false);
        if (isset($data->mrn)) {
            $patient = Patient::where('skm_mr_no' , $data->mrn)->first();
            if (! $patient) {
                $patient = new Patient();
                $patient->skm_mr_no = $data->mrn;
            }
            $patient->first_name = $data->name;
            $patient->last_name = $data->father_name;
            $patient->cnic = $data->cnic;
            $patient->dob = $data->dob;
            $patient->gender = $data->gender;
            $patient->phone_no = $data->contact;
            $patient->save();
            return $patient->id;
        }
    }
}
