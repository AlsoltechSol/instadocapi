<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;


class Appointment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $todayDate = Carbon::today();

      //  return parent::toArray($request);
      return [
        'id' => $this->id,
        'slot_id' => $this->slot_id,
        'slot_date' => $this->date,
        'new_or_old' => $this->date>$todayDate? "Upcoming":"Past",
        'slot_start_time' => $this->start_time,
        'slot_end_time' => $this->end_time,
        'weekday' =>$this->weekday,
        'doctor_id' => $this->doctor_id,
        'doctor_name' => $this->name,
        'user_id'=>$this->user_id,
        'prescribed_medicine' => 0,
        'prescription' => $this->prescription,
        'profile_photo' => isset($this->profile_photo)? "assets/patient-request/profile_photo/".$this->profile_photo:$this->profile_photo,
    ];
    }
}
