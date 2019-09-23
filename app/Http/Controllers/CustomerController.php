<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Models\Customer;
use Hash;
use Auth;
use Validator;
use Illuminate\Http\Request;

/**
 * Customer controller handles all requests that has to do with customer
 * Some methods needs to be implemented from scratch while others may contain one or two bugs.
 *
 *  NB: Check the BACKEND CHALLENGE TEMPLATE DOCUMENTATION in the readme of this repository to see our recommended
 *  endpoints, request body/param, and response object for each of these method
 *
 * Class CustomerController
 * @package App\Http\Controllers
 */
class CustomerController extends Controller
{

    /**
     * Allow customers to create a new account.
     *
     * @param CreateCustomerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $new_customer = new Customer;
        $new_customer->name = $request->name;
        $new_customer->email = $request->email;
        $new_customer->password = Hash::make($request->password);
        $new_customer->save();

        return response()->json([
            'message' => 'this works',
            'code' => 200,
            'data' => $new_customer
        ]);
    }

    /**
     * Allow customers to login to their account.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
        ]);

        
        $customer = Auth::guard('customers');
        if ($customer->attempt(['name' => $request->input('name'), 'password' => $request->input('password')])){
            return response()->json([
                'message' => 'this works',
                'code' => 200,
                'data' => $customer,
            ]);
        }else{
            return response()->json([
                'data' => 'wrong password or email',
            ]);
        }
    }

    /**
     * Allow customers to view their profile info.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCustomerProfile($customer_id)
    {
        $customer = Customer::find($customer_id);
        if($customer){
            return response()->json(['status' => 'true', 'customer' => $customer]);

        }else{
            return response()->json(['status' => 'true', 'customer' => null]);
        }
    }

    /**
     * Allow customers to update their profile info like name, email, password, day_phone, eve_phone and mob_phone.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCustomerProfile()
    {
        return response()->json(['message' => 'this works']);
    }

    /**
     * Allow customers to update their address info/
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCustomerAddress(Request $request, $customer_id)
    {
        $validator = Validator::make($request->all(), [
            'address_1' => 'required',
            'address_2' => 'required',
            'city' => 'required',
            'region' => 'required',
            'postal_code' => 'required',
            'shipping_region_id' => 'required',
        ]);

        $customer = Customer::find($customer_id);
        $customer->address_1 = $request->address_1;
        $customer->address_2 = $request->address_2;
        $customer->city = $request->city;
        $customer->region = $request->region;
        $customer->postal_code = $request->postal_code;
        $customer->shipping_region_id = $request->shipping_region_id;
        $customer->save();
        if ($customer) {
            return response()->json([
                'message' => 'this works',
                'data' => $customer
            ]);
            
        }else{
            return response()->json([
                'message' => 'Customer not found',
                'data' => null
            ]);
        }


    }

    /**
     * Allow customers to update their credit card number.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCreditCard(Request $request, $customer_id)
    {
        $validator = Validator::make($request->all(), [
            'credit_card' => 'required',
        ]);

        $customer = Customer::find($customer_id);
        $customer->credit_card = $request->credit_card;
        $customer->save();
        if ($customer) {
            return response()->json([
                'message' => 'this works',
                'data' => $customer
            ]);
            
        }else{
            return response()->json([
                'message' => 'Customer details not found',
                'data' => null
            ]);
        }


        return response()->json(['message' => 'this works']);
    }

    /**
     * Apply something to customer.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function apply(Request $request, $customer_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'day_phone' => 'required',
            'eve_phone' => 'required',
            'mob_phone' => 'required',
        ]);

        $customer = Customer::find($customer_id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->day_phone = $request->day_phone;
        $customer->eve_phone = $request->eve_phone;
        $customer->mob_phone = $request->mob_phone;
        $customer->save();
        if($customer){
            return response()->json([
                'message' => 'this works',
                'data' => $customer,
            ]);

        }else{
            return response()->json([
                'message' => 'customer not found',
                'data' => null,
            ]);
        }
    }


}
