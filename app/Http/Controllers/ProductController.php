<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //
    //
    const ITEM_PER_PAGE = 5;
    public function index(Request $request) {
        
        if(!$request->has('search')) {
            $data = Product::paginate(self::ITEM_PER_PAGE);
        } else {
            $search = $request->query('search');
            $data =  Product::where('name', 'like', '%'.$search. '%')->paginate(self::ITEM_PER_PAGE);
        }
        return response()->json([
            'data' => $data
        ], 200);
    }
    public function create(ProductRequest $productRequest) {
       try {
            if($productRequest->validated()) {
                Product::create([
                    'name' => $productRequest->name,
                    'code' => $productRequest->code,
                    'price' => $productRequest->price,
                    'store_id' => $productRequest->store,
                ]);
                return response()->json([
                    'data' => [],
                    'message' => 'Success'
                ], 200);
            }
       } catch (\Exception $e) {
            return response()->json([
                'data' => [],
                'message' => 'Errors'
            ], 200);
       }
    }
    public function detail(Request $request) {
        $id = $request->id;
        $data = [];
        if(!empty($id)) {
            $data =  Product::where('id', $id)->first();
            $store_id = $data['store_id'];
            $stores = Store::where('id', $store_id)->first();
            $data['store_name'] = $stores['name'];
            $data['address'] = $stores['address'];
        }
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ], 200);
    }
    public function update(Request $request, ProductRequest $productRequest) {
        $id = $request->id;
        $data = [];
        try {
            if(!empty($id)) {
                Product::where('id', $id)
                ->update([
                    'name' => $productRequest->name,
                    'code' => $productRequest->code,
                    'price' => $productRequest->price,
                    'store_id' => $productRequest->store
                ]);
            }
            return response()->json([
                'data' => $data,
                'message' => 'Success'
            ], 200);
        } catch (\Throwable $th) {
        //throw $th;
        return response()->json([
            'data' => $data,
            'message' => 'Errors'
        ], 200);
       }
    }
    public function delete(Request $request) {
        $id = $request->id;
        $data = [];
        try {
            if(!empty($id)) {
                Product::where('id', $id)->delete();
            }
            return response()->json([
                'data' => $data,
                'message' => 'Success'
            ], 200);
        } catch (\Throwable $th) {
        //throw $th;
        return response()->json([
            'data' => $data,
            'message' => 'Errors'
        ], 200);
       }
    }
}
