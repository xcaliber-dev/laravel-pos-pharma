<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderbyDesc('created_at')->paginate(10);
        return view('suppliers.index',compact('suppliers'));
    }

    public function store(SupplierRequest $request)
    {
        Supplier::create($request->validated());

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Suppliers created successfully'
        ]);
    }


    public function edit(Supplier $supplier)
    {
        return $supplier;
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {

    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Suppliers deleted successfully'
        ]);
    }
}
