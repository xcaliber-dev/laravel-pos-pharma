<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {


        $orders = Order::with([
            'product' => function ($query) {
                return $query->select('id', 'name', 'supplier_id');
            },
            'user' => function ($query) {
                return $query->select('id', 'name');
            },
            'product.supplier' => function ($query) {
                return $query->select('id', 'name');
            }
        ])->orderByDesc('created_at')->paginate(15);

        $query = Order::orderByDesc('created_at');

        $analysis = [
            'All Sold Quantity'=>$query->sum('quantity'),
            'Sum Of Price'=>$query->sum('total_price'),
            'All Sold Quantity Today'=>$query->where('created_at', '=', Carbon::today())->sum('quantity'),
            'Sum Of Price Today'=>$query->where('created_at', '=', Carbon::today())->sum('total_price'),
        ];


        return view('orders.index', compact('orders','analysis'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy(Order $order)
    {
        //
    }
}
