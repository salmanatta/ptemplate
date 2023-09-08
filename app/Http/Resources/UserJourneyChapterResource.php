<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserJourneyChapterResource extends JsonResource
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
            'chapterId' => $this->id,
            'chapterName' => $this->name,
            'chapterSummary' => $this->summary,
            'chapterImage' => $this->image,
            'chapterSort' => $this->sort_order,
            'chapterWeightage' => $this->passing_weightage,
            'userChapterCompleted' => (boolean) $this->userchapters?->first()?->is_completed,
            'userPlacementCompleted' => (boolean) $this->userchapters?->first()?->placement_completed,
            'userChapterPercentage' => $this->userchapters?->first()->weightage ?? 0,
            'isLocked' => !$this->userchapters->count() ? true : !$this->userchapters->first()->admin_approve ,
        ];
    }
}
