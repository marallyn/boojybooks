<?php

namespace App\Http\Controllers;

use App\Book;
use App\OpenLibraryApi as LibraryApi;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * The libraryApi for accessing nfo about books
     *
     * @var [type]
     */
    private $libraryApi;

    /**
     * Limit book viewing functionality to those logged in
     */
    public function __construct(LibraryApi $libraryApi)
    {
        $this->libraryApi = $libraryApi;
        $this->middleware('auth');
    }

    /**
     * Retrieves the book's details from the libraryApi, and sends them
     * to the book-detail page
     *
     * @param  int  $id the id of the book
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $book = Book::with('listDetails')->find($id);

        $bookDetail = $this->libraryApi->bookDetail($book->isbn);

        return view('book-detail')->with([
            'book' => $book,
            'details' => $bookDetail
        ]);
    }

}
