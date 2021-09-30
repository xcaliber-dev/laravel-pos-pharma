<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','address','phone_number'];

    public function getPhoneNumberAttribute($value)
    {
        return $value;
//        $cleaned = preg_replace('/[^[:digit:]]/', '', $value);
//        preg_match('/(\d{3})(\d{3})(\d{3})(\d{4})/', $cleaned, $matches);
//        return "(+{$matches[1]}) 750 {$matches[3]} {$matches[4]}";
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
