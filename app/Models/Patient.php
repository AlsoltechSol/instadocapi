<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'gender',
        'dateOfBirth',
        'contact_no',
        'email_id',
        'address',
        'user_id',
        'profile_photo'
    ];
}
