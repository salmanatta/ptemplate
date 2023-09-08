<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonUserQuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $userQuiz = $this->userquiz()->whereUserId($request->user()->id)->first();
        return [
            'quizId' => $this->id,
            'quizSort' => $this->sort_order,
            'quizWeightage' => $this->passing_weightage,
            'quizName' => $this->name,
            'quizIcon' => $this->icon,
            'quizDescription' => $this->description,
            'quizUserWeightage' => $userQuiz ? $userQuiz->weightage : 0,
            'quizCompleted' =>  $userQuiz ? $userQuiz->is_completed : false,
            'quizFinished' => $userQuiz ? $userQuiz->is_finished : false,
            'isLocked' => $userQuiz ? false : true,
            'noOfQuestions' => $this->questions->count()
        ];
    }
}
