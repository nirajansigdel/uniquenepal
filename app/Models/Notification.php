<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'image',
        'status',   // Added status here
    ];

    protected $casts = [
        'status' => 'boolean',  // Cast status to boolean for easy true/false handling
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
