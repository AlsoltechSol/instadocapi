<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Doctor extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'language' => $this->language,
            'yearsOfExperience' => $this->yearsOfExperience,
            'education' => $this->education,
            'fees' => $this->fees,
            'doctor_registration_no' => $this->doctor_registration_no,
            'treatment_type' => $this->treatment_type,
            'image' => isset($this->image)? "/assets/patient/attachments/".$this->image:$this->image,
            'about' => $this->about,
            'user_id' => $this->user_id,
            'slot' => $this->slot,
            'cityID' => $this->cityID,
            'hospitalID' => $this->hospitalID,
            'specializationID' => $this->specializationID,
            'symptomID' => $this->symptomID,

            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
