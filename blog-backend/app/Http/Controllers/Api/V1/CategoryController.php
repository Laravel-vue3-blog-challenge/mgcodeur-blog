<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::whereNull('parent_id')->with('categories')->get();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:2",
            "parent_id" => "exists:categories,id"
        ]);

        if($validator->fails()){
            return response()->json([
                "errors" => $validator->errors()
            ]);
        }

        $category = Category::create($request->all()); 

        return (new CategoryResource($category))
        ->additional([
            "message" => "Category created successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::with('categories')->find($id);
        if($category){
            return new CategoryResource($category);
        }
        else{
            return response()->json([
                "errors" => [
                    "message" => "Category not found!"
                ]
            ], 400);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:2",
            "parent_id" => "exists:categories,id"
        ]);

        if($validator->fails()){
            return response()->json([
                "errors" => [
                    "message" => $validator->errors()
                ]
            ]);
        }

        $category = Category::find($id);

        if($category){
            $category->update($request->all());
        }
        else{
            return response()->json([
                "errors" => [
                    "message" => "Category not found!"
                ]
            ]);
        }

        return (new CategoryResource($category))->additional(["message" => "Category updated successfully!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category){
            $category->delete();
        }
        else{
            return response()->json([
                "errors" => [
                    "message" => "Category not found!"
                ]
            ], 400);
        }

        return (new CategoryResource($category))->additional(["message" => "Category deleted successfully"]);
    }
}
