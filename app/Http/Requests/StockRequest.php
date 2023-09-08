<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Route;

class StockRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $currentRouteName = Route::currentRouteName();
        if ('specific-stock' === $currentRouteName) {
            return [
                'stockId' => 'required',
            ];
        }
        return [];
    }
}
