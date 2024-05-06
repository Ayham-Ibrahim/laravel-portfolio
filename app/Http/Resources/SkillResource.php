<?php

namespace App\Http\Resources;
use App\Models\Skill;
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
        'avarage'=>$this->avarage,
        ]
        ;
    }
}
