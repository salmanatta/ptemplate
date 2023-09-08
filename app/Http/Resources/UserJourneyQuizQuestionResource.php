<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserJourneyQuizQuestionResource extends JsonResource
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
            'uuid' => $request->userQuizId,
            'questionId' => $this->id,
            'title' => $this->title,
            'sort' => $this->sort_order,
            'answers' => QuizQuestionsAnswersResource::collection($this->answers)
        ];
    }
}
