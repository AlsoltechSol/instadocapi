<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'address1',
        'address2',
        'country',
        'state',
        'city',
        'zip',
        'user_id'
    ];
}

