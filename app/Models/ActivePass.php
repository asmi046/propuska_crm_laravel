<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivePass extends Model
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
        'anul_data',
        'series',
        'pass_number',
        'pass_zone',
        'deycount',
    ];

    protected function validFrom(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value,
            set: fn (string $value) => date("Y-m-d H:i:s", strtotime($value)),
        );
    }

    protected function setValidToAttribute($value)
    {
        $this->attributes['valid_to'] = date("Y-m-d H:i:s", strtotime($value));
    }

    protected function setAnulDataAttribute($value)
    {
        $this->attributes['anul_data'] = date("Y-m-d H:i:s", strtotime($value));
    }

    public function truc(): BelongsTo
    {
        return $this->belongsTo(CarNumber::class, 'car_number_id', 'id');
    }
}
