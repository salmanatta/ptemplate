<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDailyWalletResource extends JsonResource
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
            'portfolio_id' => $this->portfolio_id,
            'total_value' => $this->current_value,
            'profit_loss' => $this->profit_loss,
            'profit_loss_per' => $this->profit_loss_per,
            'cash_value' => $this->cash_power,
        ];
    }
}
