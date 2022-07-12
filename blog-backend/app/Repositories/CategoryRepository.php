<?php
namespace App\Repositories;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryRepository implements EloquentRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function all(): AnonymousResourceCollection
    {
        $categories = Category::whereNull('parent_id')->with('categories')->get();
        return CategoryResource::collection($categories);
    }

    /**
     * @param $request
     * @return CategoryResource
     */
    public function store($request): CategoryResource
    {
        $category = Category::create($request->all());

        return (new CategoryResource($category))
        ->additional([
            "message" => "Category created successfully"
        ]);
    }

    /**
     * @param $request
     * @param $id
     * @return CategoryResource|JsonResponse
     */
    public function update($request, $id): CategoryResource|JsonResponse
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json([
                "errors" => [
                    "message" => "Category not found!"
                ]
            ], 404);
        }
        $category->update($request->all());
        return (new CategoryResource($category))
            ->additional(["message" => "Category updated successfully!"]);
    }

    /**
     * @param $id
     * @return CategoryResource|JsonResponse
     */
    public function destroy($id): CategoryResource|JsonResponse
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json([
                "errors" => [
                    "message" => "Category not found!"
                ]
            ], 404);
        }
        $category->delete();

        return (new CategoryResource($category))
            ->additional(["message" => "Category deleted successfully"]);
    }

    /**
     * @param $id
     * @return CategoryResource|JsonResponse
     */
    public function show($id): CategoryResource|JsonResponse
    {
        $category = Category::with('categories')->find($id);
        if(!$category){
            return response()->json([
                "errors" => [
                    "message" => "Category not found!"
                ]
            ], 404);
        }
        return new CategoryResource($category);
    }
}
