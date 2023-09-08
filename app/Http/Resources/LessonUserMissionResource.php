<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;

class LessonUserMissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $mission = $this->usermission()->whereUserId($request->user()->id)->first();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
            'capital' => $this->capital ?? 0,
            'category' => $this->description ?? '',
            'type' => $this->missiontype ?? '',
            'stock_id' => $this?->stock?->stock_id ?? '',
            'stockDetails' => $this->getStockPrices($this?->stock?->stock_id ?? ''),
            'stock' => $this?->stock?->name ?? '',
            'fund' => $this?->fund?->name ?? '',
            'type_2' => $this->missiontype2 ?? '',
            'stock_2' => $this?->stock2?->name ?? '',
            'stock_2_id' => $this?->stock2?->stock_id ?? '',
            'stock2Details' => $this->getStockPrices($this?->stock2?->stock_id ?? ''),
            'fund_2' => $this?->fund2?->name ?? '',
            'isLocked' => $mission ? false : true,
            'isCompleted' => $mission ? ($mission->is_completed ? true : false) : false
        ];
    }

    public function getStockPrices($stockId) {
        try {
            if ($stockId != '') {
                $data = Http::get(config('app.dawul_url').'?stockId='.$stockId.'&locale='.app()->getLocale());
                if ($data->ok()) {
                    $obj = $data->json();
                    if ($obj['errorCode'] == '0') {
                        return [
                            'open' => $obj['data']['open'],
                            'high' => $obj['data']['high'],
                            'low' => $obj['data']['low'],
                            'close' => $obj['data']['close'],
                            'lastPrice' => $obj['data']['close'],
                            'bio' => $obj['data']['bio'],
                        ];
                    }
                }
            }
        }catch (\Throwable $exception) {
        }

    }
}
