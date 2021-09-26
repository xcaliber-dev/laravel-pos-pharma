<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $counter = [
            'suppliers'=>Supplier::count(),
            'cashiers'=>User::whereHas('role',function ($query){
                return $query->whereName('Cashier');
            })->count(),
            'products'=>Product::count(),
        ];

        return view('dashboard',compact('counter'));
    }
}
