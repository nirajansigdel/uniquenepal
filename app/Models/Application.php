<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'email',
        'phone_no',
        'address',
    ];

        public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}