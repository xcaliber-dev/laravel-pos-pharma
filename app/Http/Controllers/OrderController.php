<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
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
        ])->whereIsSold(1)->orderByDesc('created_at')->paginate(15);

        $query = Order::orderByDesc('created_at');

        $analysis = [
            'All Sold Quantity' => $query->sum('quantity'),
            'Sum Of Price' => $query->sum('total_price'),
            'All Sold Quantity Today' => $query->where('created_at', '=', Carbon::today())->sum('quantity'),
            'Sum Of Price Today' => $query->where('created_at', '=', Carbon::today())->sum('total_price'),
        ];


        return view('orders.index', compact('orders', 'analysis'));
    }


    public function create()
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
        ])->whereIsSold(0)->orderByDesc('created_at')->paginate(15);

        return view('orders.sell',compact('orders'));
    }

    public function getData(){
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
        ])->where(['user_id'=>auth()->id(),'is_sold'=>0])->orderByDesc('created_at')->get();

        return view('includes.table',compact('orders'));
    }

    public function store(Request $request)
    {
        $product = Product::whereBarcode($request->barcode)->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => __('api.product_not_found'),
            ]);
        }

        if ($product->expire_at <= now()) {
            return response()->json([
                'success' => false,
                'message' => __('api.product_expire'),
            ]);
        }

        if (!$product->stock) {
            return response()->json([
                'success' => false,
                'message' => __('api.stock_empty'),
            ]);
        }

            //reduce stock
            $product->stock -= 1;
            $product->save();

            //check if some order is there
            $order = Order::where(['user_id'=>auth()->id(),'is_sold'=>0,'product_id' =>$product->id,])->first();
            if($order){
                $order->quantity += 1;
                $order-> total_price = $order->quantity *  $order->sold_price;
                $order->save();
            }else{
                Order::create([
                    'user_id' =>auth()->id(),
                    'product_id' =>$product->id,
                    'is_sold' =>0,
                    'sold_price' =>$product->price,
                    'org_price' =>$product->price,
                    'total_price' =>$product->price,
                    'quantity' =>1]);
            }



        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => __('api.success'),
            'data' => $product
        ]);
    }

    public function undoOrder(Request $request)
    {
        //find order
        $order = Order::where(['id'=>$request->id, "user_id"=>auth()->id(),'is_sold'=>0])->first();

        if($order->quantity > 1){
            $order->quantity -= 1;
            $order->total_price = $order->quantity * $order->sold_price;
            $order->save();
        }else{
            $order->delete();
        }

        //update product
        $product = Product::find($order->product_id);
        $product->stock+=1;
        $product->save();

        return response()->json([
            'success' => true,
        ]);

    }

    public function invoice()
    {
        //find order
        $orders = Order::where(["user_id"=>auth()->id(),'is_sold'=>0])->get();
        return view('includes.invoice',compact('orders'));
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
