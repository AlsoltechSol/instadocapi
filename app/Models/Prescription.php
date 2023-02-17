<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'chief_complaints',
        'allergies',
        'diagnosis',
        'general_advice',
        'patient_id',
        'doctor_id',
        'prescribed_medicine'

      
    ];
}
