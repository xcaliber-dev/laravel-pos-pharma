<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCashierRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class CashierController extends Controller
{


    public function index()
    {
        $cashiers = User::with('role')->whereHas('role', function ($query) {
            return $query->whereName('Cashier');
        })->orderByDesc('created_at')->paginate(10);

        return view('cashier.index', compact('cashiers'));
    }


    public function create()
    {
        //
    }


    public function store(StoreCashierRequest $request)
    {
        //Store image
        $fileName = '';
        if ($request->hasFile('file')) {
            return 'as';
            $getFileNameWithExt = $request->file('file')->getClientOriginalName();
            $fileName = $request->name;
            $fileName = $fileName . '_' . time() . '.' . $request->image->extension();
            return $fileName;
            $request->image->move(public_path('uploads/profile'), $fileName);
        } else {
            $fileName = 'no_image.png';
        }


        User::create($request->safe()->except('password') + [
                'role_id' => 2,
                'image' => '/upload/users/no-image.png',
                'alt_phone' => $request->alt_phone,
                'password'=> Hash::make($request->password)
            ]);

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Cashier created successfully'
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
            'message' => 'Cashier deleted successfully'
        ]);
    }
}
