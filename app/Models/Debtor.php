<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;
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

    public function scopeFilter($builder, QueryFilter $filter) {
        return $filter->apply($builder);
    }
}
