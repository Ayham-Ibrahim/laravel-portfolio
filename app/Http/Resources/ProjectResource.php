<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SkillResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'         =>$this->title,
            'date'          =>$this->date,
            'description'   =>$this->description,
            'link'          =>$this->link,
            'github_repo'   =>$this->github_repo,
            'image'         =>Storage::url($this->image),
            'skills'        => SkillResource::collection($this->whenLoaded('skills'))
        ];
    }
}
