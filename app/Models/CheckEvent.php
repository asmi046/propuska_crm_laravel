<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckEvent extends Model
{
    use HasFactory;

    public $fillable = [
        'event_name',
        'event_date',
        'number',
        'pass_number',
        'pass_end_date',
        'important',
        'state',
    ];

    public function truc(): BelongsTo
    {
        return $this->belongsTo(CarNumber::class, 'number', 'truc_number');
    }

    public function scopeFilter($builder, QueryFilter $filter) {
        return $filter->apply($builder);
    }
}
