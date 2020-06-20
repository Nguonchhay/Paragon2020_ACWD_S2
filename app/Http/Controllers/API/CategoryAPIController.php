<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class CategoryAPIController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Get(
     *     path="/categories",
     *     summary="Category list",
     *     tags={"Category"},
     *     description="Category list",
     *     produces={"application/json"},
     *
     *     @SWG\Parameter(
     *          name="name",
     *          description="name",
     *          type="string",
     *          required=false,
     *          in="formData"
     *     ),
     *
     *     @SWG\Response(
     *      response=200,
     *      description="Category list",
     *
     *      @SWG\Schema(
     *        type="object",
     *        @SWG\Property(
     *           property="success",
     *           type="boolean"
     *        ),
     *        @SWG\Property(
     *          property="data",
     *          type="object",
     *          @SWG\Property(
     *            property="category",
     *            type="array",
     *            @SWG\Items(ref="#/definitions/Category")
     *          ),
     *        ),
     *        @SWG\Property(
     *          property="message",
     *          type="string"
     *        )
     *     )
     *   ),
     *
     *     @SWG\Response(
     *          response=500,
     *          description="Server error"
     *     )
     * )
     */
    public function index(Request $request)
    {
        if ($request->has('name')) {
            $categories = Category::where('name', 'LIKE', '%' . $request->get('name') . '%')->get();
        } else {
            $categories = Category::get();
        }

        return response()->json([
            'success' => true,
            'message' => 'Category list',
            'data' => $categories->toArray()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *     path="/categories",
     *     summary="Create new category",
     *     tags={"Category"},
     *     description="Create new category",
     *     produces={"application/json"},
     *
     *     @SWG\Parameter(
     *          name="name",
     *          description="name",
     *          type="string",
     *          required=true,
     *          in="formData"
     *     ),
     *
     *     @SWG\Response(
     *      response=200,
     *      description="Category was stored successfully.",
     *
     *      @SWG\Schema(
     *        type="object",
     *        @SWG\Property(
     *           property="success",
     *           type="boolean"
     *        ),
     *        @SWG\Property(
     *          property="data",
     *          type="object",
     *          @SWG\Property(
     *            property="category",
     *            type="array",
     *            @SWG\Items(ref="#/definitions/Category")
     *          ),
     *        ),
     *        @SWG\Property(
     *          property="message",
     *          type="string"
     *        )
     *     )
     *   ),
     *
     *     @SWG\Response(
     *          response=400,
     *          description="Missing required field"
     *     ),
     *
     *     @SWG\Response(
     *          response=500,
     *          description="Server Error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:35'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required fields',
                'data' => []
            ]);
        }

        $category = Category::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Category was stored successfully',
            'data' => $category
        ]);
    }

    public function update(Category $category, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:35'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required fields',
                'data' => []
            ]);
        }

        $category->fill($request->all());
        $category->save();
        return response()->json([
            'success' => true,
            'message' => 'Category was updated successfully',
            'data' => $category
        ]);
    }

    public function delete(Category $category)
    {
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Category was deleted successfully',
            'data' => []
        ]);
    }
}