<?php

namespace App\Http\Controllers;

use App\Book;
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

        $book = new Book;

        $book->name = $request->pname;
        $book->author = $request->pauthor;
        $book->category_id = $request->pcategoryId;
        $book->published_date = $request->ppublishedDate;
        
        $book->save();

        return redirect('books/new');
    }
}
