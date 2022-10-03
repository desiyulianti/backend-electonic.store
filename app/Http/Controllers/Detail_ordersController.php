<?php

namespace App\Http\Controllers;

use App\Models\Detail_orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Detail_ordersController extends Controller
{
    public function show()
    {
        return Detail_orders::all();
    }
    public function detail($id)
    {
        if (Detail_orders::where('id_detail_order', $id)->exists()) {
            $data = DB::table('detail_order')
                ->where('detail_order.id_detail_order', '=', $id)->get();
            return Response()->json($data);
        } else {
            return Response()->json(['message' => 'Tidak ditemukan']);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_order' => 'required',
                'id_product' => 'required',
                'qty' => 'required'
            ]
        );

        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }
        $id_detail_order = $request->id_detail_order;
        $id_product = $request->id_product;
        $qty = $request->qty;
        $harga = DB::table('product')->where('id_product', $id_product)->value('harga');
        $subtotal = $harga * $qty;

        $simpan = Detail_orders::create([

            'id_order' => $request->id_order,
            'id_product' => $id_product,
            'qty' => $qty,
            'subtotal' => $subtotal,
        ]);

        if ($simpan) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }
    public function update($id, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_order' => 'required',
                'id_product' => 'required',
                'qty' => 'required',
                'subtotal' => 'required',
            ]
        );

        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $id_product = $request->id_product;
        $qty = $request->qty;
        $harga = DB::table('product')->where('id_product', $id_product)->value('harga');
        $subtotal = $harga * $qty;

        $ubah = Detail_orders::where('id_detail_order', $id)->update([

            'id_order' => $request->id_order,
            'id_product' => $id_product,
            'qty' => $qty,
            'subtotal' => $subtotal
        ]);

        if ($ubah) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }
    public function destroy($id)
    {
        $hapus = Detail_orders::where('id_detail_order', $id)->delete();
        if ($hapus) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }
}
