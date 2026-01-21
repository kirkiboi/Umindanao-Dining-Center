<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productCreationModel extends Model
{
    protected $fillable = [
        'name', 
        'category',
        'price',
        'image'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];
}
