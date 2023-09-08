<?php

namespace App\Http\Resources;

use App\Models\Mission;
use App\Models\Quiz;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserJourneyLessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $start = md5(sha1(md5(sha1(date('hi').'_'.rand(1,1).date('s'))))).'_'.Str::random(5);
        $end = '_'.Str::random(4).md5(sha1(md5(sha1(date('si').'_'.Str::random(2).date('h'))))).'_'.Str::random(7);
        return [
            'uuid' => $this->userlessons?->first()?->id ?? uuid_create(),
            'lessonId' => $this->id,
            'lessonName' => $this->name,
            'lessonSort' => $this->sort_order,
            'lessonImage' => $this->image ? Storage::disk('common')->url($this->image) : "",
            'lessonIcon' => $this->icon,
            'lessonVideos' => $this->userlessons?->count() ? (strlen($this->videos) > 0 ? $start.$this->videos.$end : "") : "",
            'lessonVideoDuration' => $this->video_duration,
            'lessonImages' => $this->images ?? "",
            'lessonAttachments' => $this->attachements ?? "",
            'lessonSummary' => $this->summary ?? "",
            'lessonSubtitle' => $this->subtitle ?? "",
            'lessonWeightage' => $this->passing_weightage ?? 0,
            'lessonLinks' => $this->links ?? null,
            'userLessonCompleted' => (boolean) $this->userlessons?->first()?->is_completed ?? false,
            'userPlacementCompleted' => (boolean) $this->userlessons?->first()?->placement_completed ?? false,
            'userLessonPercentage' => $this->userlessons?->first()->weightage ?? 0,
            'isLocked' => (boolean) !$this->userlessons?->count(),
            'hasWatched' => (boolean) ( $this->userlessons?->first()?->is_watched ?? false),
            'hasQuiz' => (boolean) $this->quiz()->count() ?? false,
            'hasMission' => (boolean) $this->mission()->count() ?? false,
            'quizCount' => $this->quiz->count(),
            'missionCount' => $this->mission->count(),
            'quizzes' => $this->quiz->count() ? LessonUserQuizResource::collection($this->quiz) : null,
            'missions' => $this->mission->count() ? LessonUserMissionResource::collection($this->mission) : null
        ];
    }
}
