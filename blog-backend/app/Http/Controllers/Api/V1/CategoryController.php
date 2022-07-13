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
     * @OA\Get(
     *      path="/api/v1/categories",
     *      operationId="index",
     *      tags={"Categories"},
     *      security={
     *          {"passport": {}},
     *      },
     *      summary="categories lists",
     *      description="Get lists of categories",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function index() : AnonymousResourceCollection
    {
        return $this->category_repository->all();
    }

    /**
     * @OA\Post(
     ** path="/api/v1/categories",
     *   tags={"Categories"},
     *   security={
     *      {"passport": {}},
     *   },
     *   summary="store category",
     *   operationId="store",
     *
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="parent_id",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function store(CategoryRequest $request) : CategoryResource
    {
        return $this->category_repository->store($request);
    }

    /**
     * @OA\Get(
     ** path="/api/v1/categories/{id}",
     *   tags={"Categories"},
     *   security={
     *      {"passport": {}},
     *   },
     *   summary="Show a category",
     *   operationId="show",
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     **/
    public function show(int $id) : CategoryResource|JsonResponse
    {
        return $this->category_repository->show($id);
    }

    /**
     * @OA\Put(
     ** path="/api/v1/categories/{id}",
     *   tags={"Categories"},
     *   security={
     *      {"passport": {}},
     *   },
     *   summary="Update category",
     *   operationId="update",
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="parent_id",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function update(CategoryRequest $request, int $id) : CategoryResource|JsonResponse
    {
        return $this->category_repository->update($request, $id);
    }

    /**
     * @OA\Delete(
     ** path="/api/v1/categories/{id}",
     *   tags={"Categories"},
     *   security={
     *      {"passport": {}},
     *   },
     *   summary="Delete a category",
     *   operationId="destroy",
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     **/
    public function destroy(int $id) : CategoryResource|JsonResponse
    {
        return $this->category_repository->destroy($id);
    }
}
