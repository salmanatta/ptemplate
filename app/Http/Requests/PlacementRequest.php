<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Route;

class PlacementRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $currentRouteName = Route::currentRouteName();
        if ('submit-answer' === $currentRouteName) {
            return [
                'levelId' => 'required|exists:user_placement_quizzes,level_id',
                'quizId' => 'required|exists:user_placement_quizzes,quiz_id',
                'questionId' => 'required|exists:user_placement_quiz_questions_answers,question_id',
                'answerId' => 'required|exists:quiz_question_answers,id',
            ];
        }
        return [];
    }
}
