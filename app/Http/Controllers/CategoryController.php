<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admins.categories.index');
    }

    public function create()
    {
        return view('admins.categories.create');
    }

    public function store()
    {
        return redirect(route('admin.category.index'));
    }


    public function edit($id)
    {
        return view('admins.categories.edit')->with('category', null);
    }

    public function update($id)
    {
        return redirect(route('admin.category.index'));
    }

    public function delete($id)
    {
        return redirect(route('admin.category.index'));
    }
}
