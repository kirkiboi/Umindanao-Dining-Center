<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'action_type',
        'user_id',
        'previous_price',
        'new_price'
    ];

    public $timestamps = false;
    
    // Cast created_at to a datetime object
    protected $casts = [
        'created_at' => 'datetime'
    ];
}