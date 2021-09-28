<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'is_sold',
        'org_price',
        'sold_price',
        'total_price',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalPriceAttribute(){
        return $this->sold_price * $this->quantity;
    }
}
