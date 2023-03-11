<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'language',
        'yearsOfExperience',
        'education',
        'fees',
        'doctor_registration_no',
        'treatment_type',
        'image',
        'user_id',
        'about'
    ];

    public function doc_details(){
        return $this->belongsTo(User::class,'user_id');
    }
}
