<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Debtor extends Model
{
    use HasFactory;

    public $fillable = [
        'truc_number',
        'email',
        'name',
        'adding_data',
        'checing_data',
        'deys'
    ];

    protected function addingData(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value)?date("d.m.Y", strtotime($value)):null,
            set: fn ($value) => ($value)?date("Y-m-d H:i:s", strtotime($value)):null,
        );
    }

    protected function checingData(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value)?date("d.m.Y", strtotime($value)):null,
            set: fn ($value) => ($value)?date("Y-m-d H:i:s", strtotime($value)):null,
        );
    }


    public function scopeFilter($builder, QueryFilter $filter) {
        return $filter->apply($builder);
    }
}
