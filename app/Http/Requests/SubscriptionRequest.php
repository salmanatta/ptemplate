<?php

namespace App\Http\Requests;

class SubscriptionRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'subscriptionId' => 'required|exists:subscription_plans,id',
            'cardType' => 'required|integer|between:1,3',
        ];
    }
}
