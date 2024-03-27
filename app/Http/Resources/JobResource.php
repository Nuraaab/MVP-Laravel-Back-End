<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
    
        return [
            'id' =>$this->id,
            'job_title' => $this->job_title,
            'description' => $this->description,
            'location' => $this->location,
            'contact' => ['phone' => $this->user->phone_number, 'address' => $this->user->address],
            'user_id' => $this->user->id,
            'created_at' => $this->created_at,
            
        ];
    }
}
