<?php

namespace App\Http\Controllers;

use App\OpenLibraryApi as LibraryApi;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * The libraryApi for accessing nfo about books
     *
     * @var [type]
     */
    private $libraryApi;

    /**
     * Limit list functionality to those logged in
     */
    public function __construct(LibraryApi $libraryApi)
    {
        $this->libraryApi = $libraryApi;
        $this->middleware('auth');
    }

    /**
     * Display the search form
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('search');
    }

    /**
     * Asks the ibraryApi to find books with $request->field matching $request->term
     * on page $request->page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $field = $request->field ?? 'title';
        $books = $this->libraryApi->searchForBooks($field, $request->term, $request->page);

        if ($books->num_found > 0) {
            return view('search-results')->with([
                'books' => $books,
                'field' => $field,
                'num_pages' => ceil($books->num_found / 100),
                'page' => floor($books->start / 100) + 1,
                'term' => $request->term
            ]);
        } else {
            return back()->with([
                'color' => 'warning',
                'status' => 'There are no books matching your search.'
            ]);
        }
    }

    /**
     * Takes a comma separated list of isbn's, makes sure they are 13 characters
     * long, and asks the libraryApi for the details about the book.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function isbn(Request $request)
    {
        $isbnArr = \explode(',', $request->isbn);
        $books = [];
        foreach ($isbnArr as $isbn) {
            if (strlen($isbn) === 13) {
                $bookDetail = $this->libraryApi->bookDetail($isbn);
                // i came across a book with no isbn_13, even though it was fetched
                // using it's isbn_13, so we have the following check now
                if (isset($bookDetail->identifiers->isbn_13)) {
                    $books[] = $bookDetail;
                }
            }
        }

        if (count($books) > 0) {
            // yea, we found some book data from the libraryApi
            return view('book-search-results')->with([
                'books' => $books
            ]);
        } else {
            // upon further review, those isbn's were linked to books with faulty data
            return back()->with([
                'colo' => 'danger',
                'status' => 'The data for that book is faulty.'
            ]);
        }
    }
}
