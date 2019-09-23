<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Product;
use App\Models\Category;
use DB;

/**
 * The Product controller contains all methods that handles product request
 * Some methods work fine, some needs to be implemented from scratch while others may contain one or two bugs/
 *
 *  NB: Check the BACKEND CHALLENGE TEMPLATE DOCUMENTATION in the readme of this repository to see our recommended
 *  endpoints, request body/param, and response object for each of these method.
 */
class ProductController extends Controller
{

    /**
     * Return a paginated list of products.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProducts()
    {
        return response()->json([
            'status' => true, 'products' => Product::select([
                'product_id',
                'name',
                'description',
                'price',
                'discounted_price',
                'thumbnail'
            ])->paginate(10) 
        ]);
    }

    /**
     * Returns a single product with a matched id in the request params.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProduct($product)
    {
        $find_product = Product::findOrFail($product);
        return response()->json([
            'status' => true, 
            'code' => 200,
            'products' => $find_product,
        ]);
    }

    /**
     * Returns a list of product that matches the search query string.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchProduct(Request $request)
    {
        $query = $request->query;
        $products = Product::where('name','LIKE',"%$query%")
            ->orwhere('description','LIKE',"%$query%")
            ->paginate(10);
            return response()->json([
                'message' => 'this works',
                'code' => 200,
                "status" => "success",
                "data" => $products
            ]);
        
               
    }

   

    /**
     * Returns all products in a product category.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    //not done
    public function getProductsByCategory($category_id)
    {
        return response()->json([
            'status' => true, 
            'products' => Product::paginate(10) 
        ]);
    }

    /**
     * Returns list reviews for a product 
     * @return \Illuminate\Http\JsonResponse
     */
    //not done
    public function getProductsReview($product_id)
    {
        $product_review = DB::table('review')->where('review_id',$product_id)
        ->select([
            'name',
            'review',
            'rating',
            'created_on'
        ])
        ->get();
        return response()->json([
            'status' => true, 
            'products' => $product_review 
        ]);
    }

    /**
     *  allows a user to post a product review
     * @return \Illuminate\Http\JsonResponse
     */
    //not done
    public function postProductsReview(Request $request)
    {
        $product_review = DB::table('review')->insert([
            'rating' => integer($request->rating),
            'product_id' => integer($request->product_id),
            'review' => $request->review,
        ]);
        return response()->json([
            'status' => true, 
            'code' => 201,
            'products' => $product_review 
        ]);
    }

    /**
     * Returns a list of products in a particular department.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductsInDepartment($product)
    {

        $find_product = Product::findOrFail($product)
        ->join('department', 'product.product_id', '=', 'department.department_id')
        ->first();
        return response()->json([
            'message' => 'this works',
            'code' => 200,
            "status" => "success",
            "data" => $find_product
        ]);
    }

    /**
     * Returns a list of all product departments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllDepartments()
    {
        $departments = Department::all();
        return response()->json([
            'message' => 'this works',
             "status" => "success",
            "code" => 200,
            "data" => $departments,
        ]);
    }

    /**
     * Returns a single department.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDepartment($dep)
    {
        $department = Department::findOrFail($dep);
        if (!$department) {
            return response()->json(['status' => false, 'department' => $dep]);
        }else{
            return response()->json([
                'message' => 'this works',
                "status" => "success",
                "code" => 200,
                "department" => $department
            ]);
        }
    }

    /**
     * Returns all categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCategories()
    {
        return response()->json(['status' => true, 'categories' => Category::all()]);
    }

     /**
     * Returns all categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function toString($product)
    {
        $find_product = Category::findOrFail($product);
        return response()->json([
            'message' => 'this works',
            'code' => 200,
            "status" => "success",
            "product" => $find_product
        ]);
    }

    /**
     * Returns all categories in a department.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDepartmentCategories($id)
    {
        $department = Department::with('category')->find($id);
        return response()->json([
            'message' => 'this works',
            'code' => 200,
            "status" => "success",
            "category" => $department
        ]);
    }

    public function getProductCategory($product)
    {
        $find_product = Product::findOrFail($product)
        ->join('product_category', 'product.product_id', '=', 'product_category.category_id')
        ->select([
            'category_id',
            // 'deparment_id',
            'name'
        ])
        ->first();
        return response()->json([
            'message' => 'this works',
            'code' => 200,
            "status" => "success",
            "data" => $find_product
        ]);
    }


    public function getCategoryinDeparment($category)
    {
        $category = Category::with('department')->find($category);
        return response()->json([
            'message' => 'this works',
            'code' => 200,
            "status" => "success",
            "category" => $category
        ]);
    }
}
