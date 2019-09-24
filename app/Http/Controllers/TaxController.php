<?php

namespace App\Http\Controllers;
use App\Models\Tax;
use Illuminate\Http\Request;

/**
 * Tax controller contains methods which are needed for all tax request
 * Implement the functionality for the methods
 *
 *  NB: Check the BACKEND CHALLENGE TEMPLATE DOCUMENTATION in the readme of this repository to see our recommended
 *  endpoints, request body/param, and response object for each of these method
 */
class TaxController extends Controller
{
    /**
     * This method get all taxes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllTax()
    {
        $taxes = Tax::all();
        return response()->json(['message' => 'this works','data'=>$taxes]);
    }

    /**
     * This method gets a single tax using the tax id.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    
    public function getTaxById($tax_id)
    {
        $tax = Tax::where('tax_id',$tax_id)->first();
        if($tax){
            return response()->json(['status' => 'true', 'tax' => $tax]);

        }else{
            return response()->json(['status' => 'true', 'tax' => null]);
        }
    }
}
