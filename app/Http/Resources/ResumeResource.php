<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResumeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            'to-date'=>$this->to_date,
            'from-date'=>$this->from_date,
            'description'=>$this->description,
            'institute'=>$this->institute,

        ]
        ;
    }
}
