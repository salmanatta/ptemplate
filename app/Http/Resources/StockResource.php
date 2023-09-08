<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class StockResource extends JsonResource
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
            'stockId' => $this->stock_id,
            'stockName' => $this->name,
            'stockImage' => Storage::disk('stocks')->url($this->image),
            'stockPrice' => (string) $this->latest_price,
            'exchangeCode' => (string) $this->marketType->market_code,
            'sector' => (string) $this?->stocksector?->name,
        ];
    }
}
