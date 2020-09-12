<?php

namespace App\Http\Controllers;

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

        $response = array();
        $response['name'] = $name;
        $response['description'] = $description;
        $response['success'] = TRUE;

        return json_encode($response);
    }
}