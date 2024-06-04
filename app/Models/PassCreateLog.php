<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PassCreateLog extends Model
{
    use HasFactory;

    public $fillable = [
        'ip',
        'truck_num',
        'created',
        'valid_from',
        'valid_to',
        'series',
        'pass_number',
        'pass_zone',
        'type_pass',
        'sys_status'
    ];


    protected function validFrom(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value,
            set: fn (string $value) => date("Y-m-d H:i:s", strtotime($value)),
        );
    }



    protected function setCreatedAttribute($value)
    {
        $this->attributes['created'] = date("Y-m-d H:i:s", strtotime($value));
    }

    protected function setValidToAttribute($value)
    {
        $this->attributes['valid_to'] = date("Y-m-d H:i:s", strtotime($value));
    }
}
