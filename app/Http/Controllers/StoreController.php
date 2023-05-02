<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    //
    const ITEM_PER_PAGE = 5;
    public function index(Request $request) {
        
        if(!$request->has('search')) {
            $data = Store::where('status', 1)->paginate(self::ITEM_PER_PAGE);
        } else {
            $search = $request->query('search');
            $data =  Store::where('name', 'like', '%'.$search. '%')->paginate(self::ITEM_PER_PAGE);
        }
        return response()->json([
            'data' => $data
        ], 200);
    }
    public function create(StoreRequest $storeRequest) {
       try {
            if($storeRequest->validated()) {
                Store::create([
                    'name' => $storeRequest->name,
                    'address' => $storeRequest->address,
                    'status' => 1,
                    'user_id' => Auth::user()->id,
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
            $data =  Store::where('id', $id)->where('status', 1)->first();
            $user_id = $data['user_id'];
            $users = User::where('id', $user_id)->first();
            $data['user_name'] = $users['name'];
            $data['email'] = $users['email'];
        }
        return response()->json([
            'data' => $data,
            'message' => 'Success'
        ], 200);
    }
    public function update(Request $request, StoreRequest $storeRequest) {
        $id = $request->id;
        $data = [];
        try {
            if(!empty($id)) {
                Store::where('status', 1)
                ->where('id', $id)
                ->update([
                    'name' => $storeRequest->name,
                    'address' => $storeRequest->address
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
                Store::where('id', $id)->delete();
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
