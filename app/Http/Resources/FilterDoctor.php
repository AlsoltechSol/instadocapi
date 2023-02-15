<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilterDoctor extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      //  return parent::toArray($request);

      return [
        //'id' => $this->id,
        'doctorId' => $this->id,
        'name' => $this->name,

        'yearsOfExperience' => $this->yearsOfExperience,
        'education' => $this->education,
        'language' => $this->language,
        'fees' => $this->fees,
        'doctor_registration_no' => $this->doctor_registration_no,
        'image' => isset($this->image)? "/assets/patient/attachments/".$this->image:$this->image,
        'about' => $this->about,
        'treatment_type' => $this->treatment_type,
        'user_id' => $this->user_id,

        'cityID' => $this->cityID,
        'hospitalID' => $this->hospitalID,
        'specializationID' => $this->specializationID,
        'symptomID' => $this->symptomID,
       
    ];
    }
}
