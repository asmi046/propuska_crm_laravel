<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivePass extends Model
{
    use HasFactory;

    public $fillable = [
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
