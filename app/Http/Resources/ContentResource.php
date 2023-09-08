<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ContentResource extends JsonResource
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
            'page' => $this->page_key,
            'content' => ($this->content_key == 'image') ? Storage::disk('common')->url($this->content) : $this->content,
            'title' => $this->title ?? '',
            'content_type' => $this->content_key,
        ];
    }
}
