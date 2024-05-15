<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarNumber extends Model
{
    use HasFactory;

    public $fillable = [
        'truc_number',
        'email',
        'email_dop',
        'phone'
    ];

    protected $with = [
        'active_numbers',
        'no_active_numbers'
    ];


    public function active_numbers(): HasMany
    {
        return $this->hasMany(ActivePass::class);
    }

    public function no_active_numbers(): HasMany
    {
        return $this->hasMany(NoActivePasses::class);
    }

    public function scopeFilter($builder, QueryFilter $filter) {
        return $filter->apply($builder);
    }

}
