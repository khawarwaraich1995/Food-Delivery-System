<?php

namespace App\Http\Controllers\API\V1;

use App\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function getMenu(Request $request){
        $validator = Validator::make($request->all(), [
            'outletID' => 'required',
        ]);
        if (isset($validator) && $validator->fails())
        {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }else{
            $outlet_id = $request->outletID;
            $menu = Categories::where(['outlet_id' => $outlet_id, 'status' => 1])
            ->with(['menu'])
            ->orderBy('rank', 'asc')
            ->get();

            return response()->json([
                'status' => true,
                'menu' => $menu
            ], 200);
        }
    }
}
