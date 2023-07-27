<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\borrowBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.book.index', compact('books'));
    }

    public function availableBooks()
    {

        $borrowbooks = DB::select('SELECT * From books LEFT JOIN borrow_books ON books.id = borrow_books.book_id ORDER BY books.id ');
        // $borrowbooks = borrowBook::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.book.indexavailable', compact('borrowbooks'));
    }

    public function restoreBook($id)
    {
        $borrowbooks = borrowBook::findOrFail($id)->restore();
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.book.create');
    }

    public function create_reseve_books()
    {
        $users = User::all();
        $books = Book::all();
        return response()->view('cms.book.reseve', compact('users', 'books'));
    }


    public function reseve_books(Request $request)
    {
        $validator = Validator($request->all(), [

            'name' => 'required|min:3|string',


        ], []);
        if (!$validator->fails()) {
            $borrowbooks = new borrowBook();
            $borrowbooks->name = $request->input('name');
            // $borrowbooks->title = $request->input('title');
            $borrowbooks->book_id = $request->input('book_id');
            // $borrowbooks->publish_year = $request->get('publish_year');
            $borrowbooks->borrowedCopies = $request->get('borrowedCopies');
            $borrowbooks->user_id = $request->get('users');

            $save = $borrowbooks->save();
            return response()->json([
                'icon' => 'success',
                'title' => "created book Done",

            ]);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),

            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'title' => 'required|min:3|string',
            'author' => 'required|min:3|string',

        ], []);
        if (!$validator->fails()) {
            $books = new Book();
            $books->title = $request->input('title');
            $books->name = $request->input('name');
            $books->author = $request->input('author');
            $books->publish_year = $request->get('publish_year');
            $books->borrowedCopies = $request->get('borrowedCopies');
            $books->availableCopies = $request->get('availableCopies');

            $save = $books->save();
            return response()->json([
                'icon' => 'success',
                'title' => "created book Done",

            ]);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),

            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $books = Book::findOrFail($id);
        return response()->view('cms.book.edit', compact('books'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator($request->all(), [
            'title' => 'required|min:3|string',
            'author' => 'required|min:3|string',

        ], []);
        if (!$validator->fails()) {
            $books = Book::findOrFail($id);
            $books->title = $request->input('title');
            $books->name = $request->input('name');
            $books->author = $request->input('author');
            // $books->publish_year = $request->get('publish_year');
            $books->borrowedCopies = $request->get('borrowedCopies');
            $books->availableCopies = $request->get('availableCopies');

            $save = $books->save();
            return ['redirect' => route('books.index')];
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),

            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $books = Book::destroy($id);
    }
    public function destroys($id)
    {
        $borrowbooks = borrowBook::destroy($id);
        return redirect()->back();
        // return ['redirect' => route('books.index')];
    }
}