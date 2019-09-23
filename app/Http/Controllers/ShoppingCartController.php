<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\{Order,Customer};
Use Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

/**
 * Check each method in the shopping cart controller and add code to implement
 * the functionality or fix any bug.
 *
 *  NB: Check the BACKEND CHALLENGE TEMPLATE DOCUMENTATION in the readme of this repository to see our recommended
 *  endpoints, request body/param, and response object for each of these method
 *
 * Class ShoppingCartController
 * @package App\Http\Controllers
 */
class ShoppingCartController extends Controller
{

    /**
     * To generate a unique cart id.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateUniqueCart()
    {
        
        return response()->json([
            'message' => 'this works',
            'cart_id' => Str::uuid(),
        ]);
    }

    /**
     * To add new product to the cart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addItemToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required',
            'product_id' => 'required',
            'attributes' => 'required',
            'quantity' => 'required',
        ]);
        
        $data = $request->all();

        $save_cart = session()->put('get_cart', $validator);
        
        if ($save_cart) {
            return response()->json([
                'message' => 'this works',
                'data' => $save_cart
        ]);
            
        }else{
            return response()->json([
                'message' => 'this works',
                'data' => null
            ]);

        }


    }

    /**
     * Method to get list of items in a cart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCart()
    {
        return response()->json(['message' => 'this works']);
    }

    /**
     * Update the quantity of a product in the shopping cart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCartItem()
    {
        return response()->json(['message' => 'this works']);
    }

    /**
     * Should be able to clear shopping cart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function emptyCart()
    {
        return response()->json(['message' => 'this works']);
    }

    /**
     * Should delete a product from the shopping cart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeItemFromCart()
    {
        return response()->json(['message' => 'this works']);
    }

    /**
     * Create an order.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required',
            'shipping_id' => 'required',
            'tax_id' => 'required',
        ]);

        $new_order = new Order;
        $new_order->cart_id = $request->cart_id;
        $new_order->shipping_id = $request->shipping_id;
        $new_order->tax_id = $request->tax_id;
        $new_order->save();
        if ($new_order) {
            return response()->json([
                'message' => 'this works',
                'data' => $new_order
            ]);
            
        }else{
            return response()->json([
                'data' => null
            ]);
        }


    }

    /**
     * Get all orders of a customer.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCustomerOrders(Request $request)
    {
        $order_id = $request->order_id;
        $getOrder = Order::where('order_id',$order_id)->select([
            'order_id',
            'total_amount',
            'created_on',
            'shipped_on',
            // 'name'
        ])->first();
        if($getOrder){
            return response()->json([
                'message' => 'this works',
                'data' => $getOrder
            ]);

        }else{
            return response()->json([
                'data' => null
            ]);
        }

    }

    /**
     * Get  orders shortlist.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function shortDetail(Request $request, $order_id)
    {
        $getOrder = Order::where('order_id',$order_id)->select([
            'order_id',
            'total_amount',
            'created_on',
            'shipped_on',
            // 'name'
        ])->first();

        if($getOrder){
            return response()->json([
                'message' => 'this works',
                'data' => $getOrder
            ]);

        }else{
            return response()->json([
                'data' => null
            ]);
        }

    }

    

    /**
     * Get the details of an order.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrderSummary($order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            return response()->json([
                'message' => 'this works',
                'data' => $order
            ]);
            
        }else{
            return response()->json([
                'data' => null
            ]);
        }
    }

    /**
     * Process stripe payment.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function processStripePayment()
    {
        return response()->json(['message' => 'this works']);
    }
}
