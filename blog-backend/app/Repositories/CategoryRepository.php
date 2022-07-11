<?php
namespace App\Repositories;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\Category\CategoryRequest;
use App\Interfaces\EloquentRepositoryInterface;

class CategoryRepository implements EloquentRepositoryInterface
{
    private $category;

    public function all(){
        $categories = Category::whereNull('parent_id')->with('categories')->get();
        return CategoryResource::collection($categories);
    }

    public function store($request){
        $category = Category::create($request->all()); 

        return (new CategoryResource($category))
        ->additional([
            "message" => "Category created successfully"
        ]);
    }

    public function update($request, $id){
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

    public function destroy($id){
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

    public function show($id){
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
}
