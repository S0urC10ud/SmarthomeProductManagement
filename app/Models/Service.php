<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    const TYPES = ["Weather Service", "Air Conditioning Service"];


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

