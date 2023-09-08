<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;

class PortfolioRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (Route::currentRouteName() == 'activate-portfolio') {
            return [
                'portfolio_id' => 'required|numeric|digits_between:7,11',
                'broker_id' => 'required|exists:brokers,id',
                // 'nin' => 'required|digits:10|starts_with:1,2',
            ];
        }

        if (Route::currentRouteName() == 'confirm-activate-portfolio') {
            return [
                // 'nin' => 'required|digits:10|starts_with:1,2',
                'otp' => 'required',
                'broker_id' => 'required|exists:brokers,id',
                'portfolio_id' => 'required|numeric|digits_between:7,11',
            ];
        }

        if (Route::currentRouteName() == 'portfolio-wallet' || Route::currentRouteName() == 'portfolio-info') {
            return [
                'portfolio_id' => 'required|exists:user_portfolios,portfolio_id',
            ];
        }

        return [];
    }

    public function messages()
    {
        return [
            'portfolio_id.required' => __('Texts.portfolio_required'),
        ];
    }
}
