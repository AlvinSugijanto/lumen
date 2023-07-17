<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        $product = Product::where('product_status','aktif')->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data'    => $product
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|unique:product|max:255',
            'product_category' => 'required',
            'product_price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' =>   $validator->messages()
            ], 400);
        }

        try {
            $product = (new Product())->createProduct($validator->validated());

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

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|unique:product|max:255',
            'product_category' => 'required',
            'product_price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' =>   $validator->messages()
            ], 400);
        }

        try {
            $product = (new Product())->editProduct($id, $validator->validated());


            return response()->json([
                'success' => true,
                'message' => 'success',
                'data'    => $product
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
            (new Product())->deleteProduct($id);

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
