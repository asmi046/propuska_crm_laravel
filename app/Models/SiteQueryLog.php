<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteQueryLog extends Model
{
    use HasFactory;

    public $fillable = [
        'ip',
        'truck_number',
        'bot'
    ];
}
