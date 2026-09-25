<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionVisionValue extends Model
{
    use HasFactory, Translatable;

    // The table name is optional here if you follow Laravel's naming conventions.
    // protected $table = 'mission_vision_values';

    // Fields that can be mass assigned
    protected $fillable = [
        'heading',
        'description',
    ];
}
