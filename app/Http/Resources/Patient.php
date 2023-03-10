<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Patient extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'gender' => $this->gender,
            'dateOfBirth' => $this->dateOfBirth,
            'contact_no' => $this->contact_no,
            'email_id' => $this->email_id,
            'address' => $this->address,
            'user_id' => $this->user_id,
            'profile_photo' => isset($this->profile_photo)? "assets/patient-request/profile_photo/".$this->profile_photo:$this->profile_photo,
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
