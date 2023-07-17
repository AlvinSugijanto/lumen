<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{

    public function index()
    {
        $penjualan = Pembelian::where('status','aktif')->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data'    => $penjualan
        ], 200);
    }

    public function create(Request $request)
    {
        // melakukan validasi pada setiap item pada array yang dikirim
        foreach ($request->items as $items) {

            $validator = Validator::make($items, [
                'qty' => 'required',
                'product_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' =>   $validator->messages()
                ], 400);
            }
        }


        try {
            $pembelian = (new Pembelian())->createPembelian($request->items);

            if ($pembelian) {
                return response()->json([
                    'success' => true,
                    'message' => 'success',
                    'data'    => $pembelian
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function edit($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' =>   $validator->messages()
            ], 400);
        }

        try {
            $penjualan = (new Pembelian())->editPembelian($id, $validator->validated());

            return response()->json([
                'success' => true,
                'message' => 'success',
                'data'    => $penjualan
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function delete($id)
    {
        try {
            $product = (new Pembelian())->deletePembelian($id);

            return response()->json([
                'success' => true,
                'message' => 'success',
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
