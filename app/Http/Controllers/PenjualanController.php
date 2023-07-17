<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{

    public function index()
    {
        $penjualan = Penjualan::where('status','aktif')->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data'    => $penjualan
        ], 200);
    }

    public function create(Request $request)
    {
        // melakukan pada item pada array yang dikirim
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
            $product = (new Penjualan())->createPenjualan($request->items);

            if ($product) {
                return response()->json([
                    'success' => true,
                    'message' => 'success',
                    'data'    => $product
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
        // dd($request->all());
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
            $penjualan = (new Penjualan())->editPenjualan($id, $request->all());

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
            $product = (new Penjualan())->deletePenjualan($id);

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
