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
            'test_name' => $this->test_name,
            'payment_mode' => $this->payment_mode,
            'date_of_test' => $this->date_of_test,
            'prescription_exists_flag' => $this->prescription_exists_flag,
            'prescription' => $this->prescription,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
