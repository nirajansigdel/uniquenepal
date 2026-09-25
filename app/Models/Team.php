<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['name', 'phone_no', 'role', 'email', 'position', 'image'];
}
