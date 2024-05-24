<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassEvent extends Model
{
    use HasFactory;

    public $fillable = [
        'action',
        'starttime',
        'chec_id',
        'razovie',
        'postoyannie',
        'out30',
        'anul'
    ];
}
