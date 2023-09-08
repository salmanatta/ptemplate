<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
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
            'passingWeightage' => $this->passing_weightage,
            'lessonId' => $this->lesson_id,
            'name' => $this->name,
            'description' => $this->description,
            'questions' => QuizQuestionsResource::collection($this->questions),
        ];
    }
}
