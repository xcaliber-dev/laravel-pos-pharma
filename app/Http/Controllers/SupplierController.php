<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCashierRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = User::with('role')
            ->whereHas('role',function ($query){
                return $query->whereName('Sale Representative');
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('suppliers.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(StoreCashierRequest $request)
    {

        User::create($request->safe()->except('password') + [
                'role_id' => 3,
                'image' => '/upload/users/no-image.png',
                'alt_phone' => $request->alt_phone,
                'password'=> Hash::make($request->password)
            ]);

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Suppliers created successfully'
        ]);
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return $user;
    }


    public function update(Request $request, User $user)
    {
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'alt_phone'=>$request->alt_phone,
            'address'=>$request->address,
            'password'=>Hash::make($request->password),
        ]);
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Cashier updated successfully'
        ]);
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Suppliers deleted successfully'
        ]);
    }
}
