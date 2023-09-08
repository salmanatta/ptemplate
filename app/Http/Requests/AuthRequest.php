<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;

class AuthRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $currentRouteName = Route::currentRouteName();
        if ($currentRouteName == 'login') {
            return [
                'countryCode' => 'required|max:4|min:2|starts_with:+',
                'phoneNumber' => 'required|numeric|digits_between:7,15|regex:/^[0-9]+$/',
            ];
        }
        if ($currentRouteName == 'verify-otp') {
            return [
                'countryCode' => 'required|max:4|min:2|starts_with:+',
                'phoneNumber' => 'required|numeric|digits_between:7,15|regex:/^[0-9]+$/',
                'otp' => 'required|numeric'
            ];
        }
        if ($currentRouteName == 'resend-otp') {
            return [
                'phoneNumber' => 'required',
                'countryCode' => 'required|max:4|min:2|starts_with:+',
            ];
        }
    }
}
