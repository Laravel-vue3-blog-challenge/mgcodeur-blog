<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Category\CategoryRequest;

class CategoryController extends Controller
{
    private CategoryRepository $category_repository;

    /**
     * @param CategoryRepository $category_repository
     */
    public function __construct(CategoryRepository $category_repository){
        $this->category_repository = $category_repository;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return $this->category_repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return CategoryResource
     */
    public function store(CategoryRequest $request) : CategoryResource
    {
        return $this->category_repository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CategoryResource|JsonResponse
     */
    public function show(int $id) : CategoryResource|JsonResponse
    {
        return $this->category_repository->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return CategoryResource|JsonResponse
     */
    public function update(CategoryRequest $request, int $id) : CategoryResource|JsonResponse
    {
        return $this->category_repository->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return CategoryResource|JsonResponse
     */
    public function destroy(int $id) : CategoryResource|JsonResponse
    {
        return $this->category_repository->destroy($id);
    }
}
