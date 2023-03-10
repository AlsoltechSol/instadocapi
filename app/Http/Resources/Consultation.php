<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Consultation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            // 'id' => $this->id,
            'doctor_id' => $this->doctorID,
            'doctor_name' => $this->doctorName,
            'doctor_image' => isset($this->doctorImage)? "assets/patient/attachments/".$this->doctorImage:$this->doctorImage,
        
            'slot_date' => $this->slotDate,
          
            'weekday' =>$this->slotWeekday,
            'slot_time' => $this->slotTime,
            'chief_complaints' => $this->chief_complaints,
            'allergies' => $this->allergies,
            'diagnosis' => $this->diagnosis,
            'general_advice' => $this->general_advice,

            'user_id'=>$this->user_id,
        
            'prescription' => isset($this->prescription)? "assets/patient/appointment/prescription/".$this->prescription:$this->prescription,
            'prescription_medicine' => $this->medicines,
        ];
    }
}
