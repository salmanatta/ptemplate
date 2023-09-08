<?php

namespace App\Http\Requests;


use App\Rules\EmailRule;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Mohamedsabil83\LaravelHijrian\LaravelHijrian;

class UserInfoRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $currentRouteName = Route::currentRouteName();
        if ('update-personal-info' === $currentRouteName) {
//            $dt = new Carbon();
//            $date_new = LaravelHijrian::gregory(request()->dob)->format('d-m-Y');
//            request()->merge(['dob' => $date_new]);
//            $before18Years = $dt->subYears(18)->format('Y-m-d');
            return [
                'email' => ['required', 'email', new EmailRule, 'max:50'],
//                'dob' => ['required', 'before:' . $before18Years],
                'dob' => ['required'],
                'maritalStatus' => ['required', 'max:50', Rule::in(getKycValues()['marital_status']), 'not_in:' . __('message.KYC_VALUES.SELECT')],
                'dependents' => 'required|numeric',
                'education' => ['required', 'max:100', Rule::in(getKycValues()['education']), 'not_in:' . __('message.KYC_VALUES.SELECT')],
                'username' => 'required|max:100'
            ];
        }

        if ('update-employment-status' === $currentRouteName) {
            return [

                'status' => ['required', 'max:100', Rule::in(getKycValues()['employment']), 'not_in:' . __('message.KYC_VALUES.SELECT')],
                'type' =>  ['required', 'max:100', Rule::in(getKycValues()['type']), 'not_in:' . __('message.KYC_VALUES.SELECT')],
                'employerName' => 'required|max:100',
                'industry' => ['required', 'max:100', Rule::in(getKycValues()['industry']), 'not_in:' . __('message.KYC_VALUES.SELECT')],
                'position' =>  ['required', 'max:100'],
                'address' => 'required|max:150'
            ];
        }

        if ('update-financial-info' === $currentRouteName) {
            return [
                'annualIncome' => ['required', 'numeric', 'min:0'],
                'netWorth' => ['required', 'numeric', 'min:0'],
                'liquidNetWorth' => ['required', 'numeric', 'min:0'],
                'investedCapital' => ['required', 'numeric', 'min:0'],
                'source' => ['required', 'max:100', Rule::in(getKycValues()['wealthSource']), 'not_in:' . __('message.KYC_VALUES.SELECT')],
            ];
        }

        if ('update-risk-info' === $currentRouteName) {
            return [
                'knowledge' => ['required', 'max:100', Rule::in(getKycValues()['knowledge']), 'not_in:' . __('message.KYC_VALUES.SELECT')],
                'objective' => ['required', 'max:100', Rule::in(getKycValues()['investmentObjective']), 'not_in:' . __('message.KYC_VALUES.SELECT')],
                'period' => ['required', 'max:100', Rule::in(getKycValues()['expectedInvestmentPeriod']), 'not_in:' . __('message.KYC_VALUES.SELECT')],
                'periodRecover' => ['required', 'max:100', Rule::in(getKycValues()['expectedPeriodToRecover']), 'not_in:' . __('message.KYC_VALUES.SELECT')],
            ];
        }

        if ('update-profile-picture' === $currentRouteName) {
            return [
                'image' => ['required'],
            ];
        }
        return [];
    }
}
