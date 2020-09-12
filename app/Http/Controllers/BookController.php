<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        $books = Book::all();
        return view('book.index', ['books' => $books]);
    }

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

        return redirect('books');
    }

    public function edit($id) {
        $book = Book::find($id);
        $categories = Category::all();
        return view('book.book_form', ['book' => $book, 'categories' => $categories, 'title' => 'Edit book']);
    }

    public function update(Request $request, $id) {
        $name = $request->pname;
        $author = $request->pauthor;
        $category_id = $request->pcategoryId;
        $published_date = $request->ppublishedDate;

        $book = Book::find($id);

        $book->name = $name;
        $book->author = $author;
        $book->category_id = $category_id;
        $book->published_date = $published_date;

        $book->save();

        return redirect('books');
    }
}
