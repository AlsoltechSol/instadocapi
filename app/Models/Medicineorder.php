<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicineorder extends Model
{
    use HasFactory;

    protected $table = 'medicine_orders';
    protected $fillable = [
        'prescription',
        'cost',
        'due_date',
        'order_status',
        'payment_mode',
        'patient_id',
        'user_id',
        'course_duration',
        'have_prescription',
        'address'

    ];
}
