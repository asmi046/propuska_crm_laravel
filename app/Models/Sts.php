<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sts extends Model
{
    use HasFactory;

    public $fillable = [
        'truc_number',
        'email',
        'sts_data',
        'last_message'
    ];


    protected function stsData(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value)?date("d.m.Y", strtotime($value)):null,
            set: fn ($value) => ($value)?date("Y-m-d", strtotime($value)):null,
        );
    }

    protected function lastMessage(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value)?date("d.m.Y", strtotime($value)):null,
            set: fn ($value) => ($value)?date("Y-m-d H:i:s", strtotime($value)):null,
        );
    }
}
