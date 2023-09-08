<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Route;

class JourneyRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $currentRouteName = Route::currentRouteName();
        if ('journey-chapters' === $currentRouteName) {
            return [
                'levelId' => 'required|exists:levels,id',
            ];
        }
        if ('journey-lessons' === $currentRouteName) {
            return [
                'chapterId' => 'required|exists:chapters,id',
            ];
        }
        if ('journey-quizzes' === $currentRouteName) {
            return [
                'lessonId' => 'required|exists:lessons,id|exists:quizzes,lesson_id',
            ];
        }
        if ('journey-missions' === $currentRouteName) {
            return [
                'lessonId' => 'required|exists:lessons,id',
            ];
        }
        if ('journey-quiz-questions' === $currentRouteName) {
            return [
                'quizId' => 'required|exists:quizzes,id|exists:user_quizzes,quiz_id',
            ];
        }
        if ('journey-lessons-watched' === $currentRouteName) {
            return [
                'lessonId' => 'required|exists:lessons,id|exists:user_lessons,lesson_id',
                'watched' => 'required|between:0,100',
            ];
        }
        if ('quiz-question-submit' === $currentRouteName) {
            return [
                'quizId' => 'required|exists:user_quizzes,id',
                'questionId' => 'required|exists:user_quiz_answers,question_id',
                'answerId' => 'required|exists:quiz_question_answers,id',
            ];
        }
        if ('mission-submit' === $currentRouteName) {
            return [
                'missionId' => 'required|exists:missions,id',
            ];
        }
        return [];
    }
}
