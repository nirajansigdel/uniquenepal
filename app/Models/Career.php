<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'title',
        'description',
        'location',
        'date',
        'time',
        'spots_available',
        'salary',
        'requirements',
        'image',
        'status'
    ];

    protected $casts = [
        'date' => 'date',
        'status' => 'boolean',
    ];

    public function getFormattedDateAttribute()
    {
        return $this->date->format('F d, Y');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('uploads/careers/' . $this->image);
        }
        return null;
    }

    public function applications()
    {
        return $this->hasMany(CareerApplication::class);
    }
}
