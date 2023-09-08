<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => 'Yearly',
            'perMonth' => $this->chargeable / 12,
            'plan' => $this->feature ? $this->feature->name : '',
            'amount' => $this->amount,
            'discount' => $this->discount,
            'vat' => $this->vat,
            'vatAmount' => $this->vatamount,
            'duration' => $this->duration / 30 . ' Month(s)',
            'startDate' => date('d/m/Y'),
            'endDate' => Carbon::now()->addMonths(($this->duration / 30))->format('d/m/Y'),
            'chargeable' => $this->chargeable,
        ];
    }
}
