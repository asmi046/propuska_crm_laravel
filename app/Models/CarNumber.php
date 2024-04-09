<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarNumber extends Model
{
    use HasFactory;

    public $fillable = [
        'truc_number',
        'email',
        'email_pop',
        'phone',
        'time',
        'pass_time',
        'status',
        'sys_status',
        'chec_time',
        'start_data',
        'end_data',
        'anul_data',
        'seria',
        'pass_number',
        'pass_type',
        'dey_count',
    ];
}
