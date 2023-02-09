<?php

namespace App\Http\Controllers\Admin;

use App\Category;


class CategoryController extends AdminController{

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit($id)
    {

    }

    public function update()
    {

    }
    public function destroy()
    {

    }

}