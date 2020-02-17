<?php

namespace App\Http\Controllers;

use App\Book;
use App\Traits\OpenLibrary;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use OpenLibrary;

    /**
     * Limit book viewing functionality to those logged in
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Retrieves the book's details from openlibrary, and sends them
     * to the book-detail page
     *
     * @param  int  $id the id of the book
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $book = Book::with('listDetails')->find($id);

        $bookDetail = $this->bookDetail($book->isbn);

        return view('book-detail')->with([
            'book' => $book,
            'details' => $bookDetail
        ]);
    }

}
