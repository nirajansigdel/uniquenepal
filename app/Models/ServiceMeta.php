<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceMeta extends Model
{
    use HasFactory;

    protected $table = 'service_metas';

    protected $fillable = [
        'title',
        'description',
    ];
}
