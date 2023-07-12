<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'uuid',
        'name',
        'code',
        'photo',
        'price',
        'stock'
    ];
}
