<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $num = config('setting.pagination_category_list');
        $categories = Category::paginate($num);
        return view('admins.categories.index')->with('categories', $categories);
    }

    public function create()
    {
        return view('admins.categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->all());
        return redirect(route('admin.category.index'));
    }


    public function edit($id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            return redirect(route('admin.category.index'));
        }

        return view('admins.categories.edit')->with('category', $category);
    }

    public function update($id, Request $request)
    {
        /** @var Category $category */
        $category = Category::find($id);
        if (empty($category)) {
            return redirect(route('admin.category.index'));
        }

        $category->fill($request->all());
        $category->save();

        return redirect(route('admin.category.index'));
    }

    public function delete($id)
    {
        /** @var Category $category */
        $category = Category::find($id);
        if (empty($category)) {
            return redirect(route('admin.category.index'));
        }
        $category->delete();
        return redirect(route('admin.category.index'));
    }

    public function deleteAjax($id)
    {
        /** @var Category $category */
        $category = Category::find($id);
        if (empty($category)) {
            return response()->json([
                'success' => false,
                'message' => 'Category was not found.'
            ]);
        }

        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Category was deleted successfully'
        ]);
    }
}
