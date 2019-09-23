<?php

namespace App\Http\Controllers\Api;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    
    /**
     * Return a paginated list of department.
     *
     * @return \Illuminate\Http\JsonResponse
     */

     public function all_department()
     {
         $departments = Department::latest()->paginate(10);

         $response = [
            "status" => "success",
            "code" => 200,
            "data" => $departments
        ];

        // return the custom in JSON format
        return response()->json($response);

     }

     public function FunctionName(Type $var = null)
     {
         # code...
     }

}
