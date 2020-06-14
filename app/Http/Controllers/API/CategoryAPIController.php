<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class CategoryAPIController extends Controller
{
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