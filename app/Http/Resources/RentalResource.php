<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      return [
            'id' => $this->id,
            'title'=>$this->title,
            'description' => $this->description,
            'contact' => ['phone' =>$this->user->phone_number, 'address'=> $this->user->address],
            'location' => $this->location,
            'photo' => $this->photo,
            'price' => $this->price,
            'user_id' => $this->user->id,
            'name'=>$this->user->name,
            'created_at' => $this->created_at,
            'profile' => $this->user->profile,
           ];
    }
}
