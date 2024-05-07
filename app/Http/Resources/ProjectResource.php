<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'title'=>$this->title,
        'date'=>$this->date,
        'description' =>$this->description,
        'image' =>$this->image,
        'link' =>$this->link,
        'github-repo' =>$this->github_repo,
        ]
        ;
    }
}
