<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserWalletResource extends JsonResource
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
            'stock_id' => $this->stock_id,
            'stock_name' => $this->stock->name,
            'stock_logo' => isset($this->stock->image) ? Storage::disk('stocks')->url($this->stock->image) : Storage::disk('stocks')->url('default.png'),
            'stock_currency' => $this->stock->marketType->currency,
            'quantity' => $this->quantity,
            'avg_buy_price' => $this->avg_buy_price,
            'current_price' => $this->current_price,
            'current_value' => $this->current_value,
            'profit_loss' => $this->profit_loss,
            'profit_per' => $this->profit_per,
            'wallet_per' => (string) ($this->wallet_per * 100),
            'invested' => $this->invested,
        ];
    }
}
