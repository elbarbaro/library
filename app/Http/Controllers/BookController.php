<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index() {
        $books = Book::paginate(10);
        $categories = DB::table('categories')->select('id', 'name')->get();
        $authors = DB::table('books')->distinct()->pluck('author');
        return view('book.index', ['books' => $books, 'categories' => $categories, 'authors' => $authors]);
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

    public function destroy($id) {
        Book::destroy($id);
        return redirect('books');
    }
}
