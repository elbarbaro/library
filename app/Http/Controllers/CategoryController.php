<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create() {
        return view('category.category_form');
    }

    public function store(Request $request) {
        $name = $request->pname;
        $description = $request->pdescription;

        $category = new Category();
        $category->name = $name;
        $category->description = $description;

        $category->save();

        return redirect('categories/new');
    }
}