<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::pluck('name','id')->toArray();
        $products =  Product::with('supplier')->orderByDesc('created_at')->paginate(15);
        return view('prodcuts.index',compact('products','suppliers'));
    }



    public function store(ProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Suppliers created successfully'
        ]);
    }



    public function edit(Product $product)
    {
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Suppliers deleted successfully'
        ]);
    }

    public function notLeft()
    {
        $suppliers = Supplier::pluck('name','id')->toArray();
        $products =  Product::with('supplier')->where('stock','<',3)->orderByDesc('created_at')->paginate(15);
        return view('prodcuts.not_left',compact('products','suppliers'));
    }

    public function debt()
    {
        $suppliers = Supplier::pluck('name','id')->toArray();
        $products =  Product::with('supplier')->whereIsDept(1)->orderByDesc('created_at')->paginate(15);
        return view('prodcuts.debt',compact('products','suppliers'));
    }

    public function expire()
    {
        $suppliers = Supplier::pluck('name', 'id')->toArray();
        $products = Product::with('supplier')->where('expire_at' , '<=',now())->orderByDesc('created_at')->paginate(15);
        return view('prodcuts.expire', compact('products', 'suppliers'));
    }
}
