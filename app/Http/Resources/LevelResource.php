<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LevelResource extends JsonResource
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
            'sortOrder' => $this->sort_order,
            'image' => $this->image,
            'passingWeightage' => $this->passing_weightage,
            'level' => $this->name,
            'quiz' => QuizResource::collection($this->placementquizzes),
        ];
    }
}
