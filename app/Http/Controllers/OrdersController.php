<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Detail_orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{

    public function show()
    {
        return Orders::all();
    }

    public function detail($id)
    {
        if (Orders::where('id_order', $id)->exists()) {
            $data = Orders::join('detail_order', 'detail_order.id_order', 'orders.id_order')
                ->where('orders.id_order', '=', $id)->get();

            return Response()->json($data);
        } else {
            return Response()->json(['message' => 'Tidak ditemukan']);
        }
    }


    public function store(Request $request)
    {
        $data=array(

            'tgl_order' => date('Y-m-d'),
            'subtotal' => 0
        );
        $proses=Orders::create($data);

        if($proses){
            $id_order=$proses->id_order;
            $subtotal=0;
            foreach ($request->get('datapost') as $gdata) {
                $insert_detail=Detail_orders::create([
                    'id_order'=>$id_order,
                    'id_product'=>$gdata['id_product'],
                    'qty'=>$gdata['quantity'],
                ]);
                $subtotal+=$gdata['harga']*$gdata['quantity'];
            }
            $updatetransaksi=Orders::where('id_order', $id_order)->update([
                'subtotal'=>$subtotal
            ]);
            return Response()->json(['status' => 1, 'message' => 'Success add transaction']);
        } else {
            return Response()->json(['status' => 0, 'message' => 'Failed add transaction']);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [

               
                'id_customer' => 'required',
                'tgl_order' => 'required',

            ]
        );
        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }
        $ubah = Orders::where('id_order', $id)->update([

            'id_customer' => $request->id_customer,
            'tgl_order' => date("Y-m-d")

        ]);
        if ($ubah) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }
    public function destroy($id)
    {
        $hapus = Orders::where('id_order', $id)->delete();
        if ($hapus) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }
}