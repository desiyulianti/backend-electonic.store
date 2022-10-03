<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CustomersController extends Controller
{
    public function show()
    {
        return Customers::all();
    }
    public function detail($id)
    {
        if(Customers::where('id_customer', $id)->exists()) {
            $data = Customers::where('customers.id_customer', '=', $id)
            ->get();
            return Response()->json($data);
        }
        
        else {
            return Response()->json(['message' => 'not found' ]);
        }
        }


    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required',
                'alamat' => 'required',
                'telp' => 'required',
                'username' => 'required',
                'password' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }
        $simpan = Customers::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);
        if ($simpan) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }
    public function update($id_customer, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required',
                'alamat' => 'required',
                'telp' => 'required',
                'username' => 'required',
                'password' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }
        $ubah = Customers::where('id_customer', $id_customer)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);
        if ($ubah) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }
    public function destroy($id_customer)
    {
        $hapus = Customers::where('id_customer', $id_customer)->delete();
        if ($hapus) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }
}
