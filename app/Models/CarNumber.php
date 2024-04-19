<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarNumber extends Model
{
    use HasFactory;

    public $fillable = [
        'truc_number',
        'email',
        'email_dop',
        'phone'
    ];


    public function active_numbers(): HasMany
    {
        return $this->hasMany(ActivePass::class);
    }

}
