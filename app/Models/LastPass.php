<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LastPass extends Model
{
    use HasFactory;

    public $fillable = [
        'car_number_id',
        'type_pass',
        'status',
        'sys_status',
        'sys_color',
        'chec_time',
        'valid_from',
        'valid_to',
        'cancel_date',
        'series',
        'pass_number',
        'pass_zone',
        'deycount',
    ];


    protected function validFrom(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value)?date("d.m.Y", strtotime($value)):null,
            set: fn (string $value) => date("Y-m-d H:i:s", strtotime($value)),
        );
    }

    protected function validTo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value)?date("d.m.Y", strtotime($value)):null,
            set: fn (string $value) => date("Y-m-d H:i:s", strtotime($value)),
        );
    }

    protected function cancelDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value)?date("d.m.Y", strtotime($value)):null,
            set: fn ($value) => ($value)?date("Y-m-d H:i:s", strtotime($value)):null,
        );
    }

    public function truc(): BelongsTo
    {
        return $this->belongsTo(CarNumber::class, 'car_number_id', 'id');
    }
}
