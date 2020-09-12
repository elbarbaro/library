<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create() {

        $categories = Category::all();
        return view('book.book_form', ['categories' => $categories]);
    }

    public function store(Request $request) {
        return json_encode($request->all());
    }
}
