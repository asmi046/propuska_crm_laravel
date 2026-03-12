<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RnisSubscribe extends Model
{
    use HasFactory;

    public $fillable = [
        'truc_number',
        'end_subscribe',
    ];

    public function car_number(): BelongsTo
    {
        return $this->belongsTo(CarNumber::class, 'truc_number', 'truc_number');
    }

    protected function endSubscribe(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value) ? date('d.m.Y', strtotime($value)) : null,
            set: fn ($value) => ($value) ? date('Y-m-d', strtotime($value)) : null,
        );
    }
}
