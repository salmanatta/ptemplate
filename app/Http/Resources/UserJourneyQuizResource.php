<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserJourneyQuizResource extends JsonResource
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
            'quizId' => $this->quiz->id,
            'quizName' => $this->quiz->name,
            'quizDescription' => $this->quiz->description ?? "",
            'quizWeightage' => $this->weightage ?? 0,
            'quizCompleted' => (boolean) $this->is_completed,
            'quizFinished' => (boolean) $this->is_finished,
            'isLocked' => false,
            'noOfQuestions' => $this->quiz->questions->count()

        ];
    }
}
