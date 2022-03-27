<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Customers;
use Validator;

class CustomersController extends Controller
{
    public function customersLogin(Request $request){

        $data = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $user = Customers::where('email', $request->email)->first();
        //dd($user);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'status' => false,
                'message' => 'These credentials do not match our records!'
            ], 200);
        }
    
        $token = $user->createToken('my-app-token')->plainTextToken;
    
        $response = [
            'status' => true,
            'user' => $user,
            'token' => $token
        ];
    
        return response($response, 201);
    }

    public function customersRegistration(Request $request, Customers $customer)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ]);
        if (isset($validator) && $validator->fails())
        {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->password = Hash::make($request->password);
            $customer->save();
            if($customer->id > 0)
            {
                return response()->json([
                    'status' => true,
                    'message' =>   'Your account has been registered successfully!'
                ], 201);
            }

    }
    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'customerID' => 'required',
            'name' => 'required',
        ]);
        if (isset($validator) && $validator->fails())
        {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        $customer = Customers::find($request->customerID);
        $customer->name = $request->name;
        if(!empty($request->phone))
        {
            $phone = preg_replace('/\s+/', '', $request->phone);
            $customer->phone = $phone ?? '';
        }
        $customer->save();
        if($customer->id > 0)
        {
            return response()->json([
                'status' => true,
                'message' =>   'Your profile has been updated!',
                'user' => $customer
            ], 200);
        }
    }
    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'customerID' => 'required',
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|different:oldPassword',
            'confirmPassword' => 'required|same:newPassword',
        ]);
        if (isset($validator) && $validator->fails())
        {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        $customer = Customers::find($request->customerID);
        if(!empty($customer))
        {
            if (Hash::check($request->oldPassword, $customer->password)) { 
                 $customer->password = Hash::make($request->newPassword);
                 $customer->save();
             
                 return response()->json([
                    'status' => true,
                    'message' => 'Password updated successfully!'
                ], 200);
             
             } else {
                return response()->json([
                    'status' => false,
                    'errors' => ['oldPassword' => ['Old password does not matched!']]
                ], 422);
             }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'User not found!'
            ], 422);
        }
        
    }
}
