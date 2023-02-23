<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'slot_id',
        'doctor_id',
        'appointment_status',
        'name',
        'mobile',
        'payment_status',
        'payment_mode',
        'appointment_date',
        'email',
        'course_duration',
        'have_prescription',
        'address'

    ];
}
