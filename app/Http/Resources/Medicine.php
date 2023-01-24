<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Medicine extends JsonResource
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
            'prescription' => "/assets/medicineorderuploads/prescription/".$this->prescription,
            'cost' => $this->cost,
            'due_date' => $this->due_date,
            'order_status' => $this->order_status,
            'payment_mode' => $this->payment_mode,
            'patient_id' => $this->patient_id,
            'user_id' => $this->user_id,
            'course_duration' => $this->course_duration,
            'address' => $this->address,
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
