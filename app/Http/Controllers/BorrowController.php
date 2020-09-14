<?php

namespace App\Http\Controllers;

use App\Borrow;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    function store(Request $request) {
        $borrow = new Borrow;

        $borrow->book_id = $request->id;
        $borrow->user = $request->puser;

        $borrow->save();

        return redirect()->action('BookController@show', ['id' => $request->id])->with('result', 'User created correctly');
    }
}
