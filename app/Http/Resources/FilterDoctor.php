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
        'cityID' => $this->cityID,
        'hospitalID' => $this->hospitalID,
        'specializationID' => $this->specializationID,
        'symptomID' => $this->symptomID,
       
    ];
    }
}
