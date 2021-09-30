<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
}
