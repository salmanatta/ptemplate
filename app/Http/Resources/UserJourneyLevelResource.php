<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserJourneyLevelResource extends JsonResource
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
            'levelId' => $this->id,
            'levelName' => $this->name,
            'levelImage' => $this->image ? Storage::disk('common')->url($this->image) : "",
            'levelSort' => $this->sort_order,
            'levelWeightage' => $this->passing_weightage,
            'userLevelCompleted' => $this->userlevels->count() ? $this->userlevels->first()->is_completed : false,
            'userPlacementCompleted' => $this->userlevels->count() ? $this->userlevels->first()->placement_completed : false,
            'userLevelPercentage' => $this->userlevels->count() ? $this->userlevels->first()->weightage : 0,
            'currentLevel' => $this->users->count() ? true : false,
            'isLocked' => $this->userlevels->count() ? false : ($this->users->count() ? false : true),
        ];
    }
}
