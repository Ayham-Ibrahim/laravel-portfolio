<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'         => $this->name,
            'phone_number' => $this->phone_number,
            'birth_date'   => $this->birth_date,
            'country'      => $this->country,
            'city'         => $this->city,
            'address'      => $this->address,
            'website'      => $this->website,
            'email'      => $this->email,
            'job_title'    => $this->job_title,
            'first_image'  => Storage::url($this->first_image),
            'second_image' => Storage::url($this->second_image),
            'cv'           => Storage::url($this->cv),
        ];
    }
}
