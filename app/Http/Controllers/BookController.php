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
        $books = Book::latest()->paginate(10);
        $categories = DB::table('categories')->select('id', 'name')->get();
        $authors = DB::table('books')->distinct()->pluck('author');
        return view('book.index', ['books' => $books, 'categories' => $categories, 'authors' => $authors]);
    }

    public function show($id) {
        $book = Book::find($id);
        return view('book.show', ['book' => $book]);
    }

    public function search(Request $request) {
        $categoryIds = $request->input('categoryId');
        $authors = $request->input('author');
        $status = $request->input('status');
        $borrow = $request->input('borrow');

        $books = Book::query();
        if($categoryIds){
            $books = $books->whereIn('category_id', $categoryIds);
        }
        if($authors) {
            $books->where(function($query) use ($authors) {
                return $query->whereIn('author', $authors);
            });
        }
        if($status){
            $books->where(function($query) use ($status) {
                return $query->whereIn('status', $status);
            });
        }
        if($borrow) {
            $books->borrowed();
        }
        $books = $books->paginate(10);
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

    public function status(Request $request) {
        $book = Book::find($request->id);
        if($book) {
            $book->status = !$book->status;
            $book->save();
            $code = 200;
            $data = ['success' => TRUE, 'status' => $book->status];
        } else {
            $code = 400;
            $data = ['success' => FALSE, 'status' => null];
        }
        
        return response()->json($data, $code);
    }
}
