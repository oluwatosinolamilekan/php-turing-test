<?php

namespace App\Http\Controllers;
use App\Models\{Attribute,AttributeValue,ProductAttribute};
use Illuminate\Http\Request;

/**
 * The controller defined below is the attribute controller.
 * Some methods needs to be implemented from scratch while others may contain one or two bugs.
 *
 * NB: Check the BACKEND CHALLENGE TEMPLATE DOCUMENTATION in the readme of this repository to see our recommended
 *  endpoints, request body/param, and response object for each of these method
 *
 *
 * Class AttributeController
 * @package App\Http\Controllers
 */
class AttributeController extends Controller
{
    /**
     * This method should return an array of all attributes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllAttributes()
    {
        $attributes = Attribute::all();
        return response()->json([
            'message' => 'this works',
            'data' => $attributes,
            'code' => 200,

        ]);
    }

    /**
     * This method should return a single attribute using the attribute_id in the request parameter.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSingleAttribute($id)
    {
        $find_attribute = Attribute::find($id);

        return response()->json([
            'message' => 'this works',
            'code' => 200,
            'data'=>$find_attribute
        ], 200);
    }

    /**
     * This method should return an array of all attribute values of a single attribute using the attribute id.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAttributeValues($value)
    {
        $attribute_value = AttributeValue::select(['attribute_value_id','value'])->findOrFail($value);
        return response()->json([
            'message' => 'this works',
            'code' => 200,
            'data' => $attribute_value
        ]);
    }

    /**
     * This method should return an array of all the product attributes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductAttributes($product_id)
    {
        $product_attribute = ProductAttribute::where('customer_id',$product_id)->first();
        return response()->json([
            'message' => 'this works',
            'code' => 200,
            'data' => $product_attribute
        ]);

    }
}
