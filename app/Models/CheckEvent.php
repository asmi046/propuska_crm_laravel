<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckEvent extends Model
{
    use HasFactory;

    public $fillable = [
        'event_name',
        'event_date',
        'number',
        'pass_number',
    ];
}
