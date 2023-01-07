<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labtest extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_name',
        'payment_mode',
        'date_of_test',
        'prescription_exists_flag',
        'prescription',
        'user_id'
    ];
}
