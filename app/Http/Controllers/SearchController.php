<?php

namespace App\Http\Controllers;

use App\Traits\OpenLibrary;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use OpenLibrary;

    /**
     * Set up auth middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the search form
     *
     * @return void
     */
    public function index()
    {
        return view('search');
    }

    /**
     * Perform the search and return the results
     *
     * @return void
     */
    public function search(Request $request)
    {
        $field = $request->field ?? 'title';
        $books = $this->searchForBooks($field, $request->term, $request->page);

        return view('search-results')->with([
            'books' => $books,
            'field' => $field,
            'num_pages' => ceil($books->num_found / 100),
            'page' => floor($books->start / 100) + 1,
            'term' => $request->term
        ]);
    }

    /**
     *
     *
     * @return void
     */
    public function isbn(Request $request)
    {
        $isbnArr = \explode(',', $request->isbn);
        $books = [];
        foreach ($isbnArr as $isbn) {
            if (strlen($isbn) === 13) {
                $bookDetail = $this->bookDetail($isbn);
                // i came across a book with no isbn_13, even though it was fetched
                // using it's isbn_13, so we have the following check now
                if (isset($bookDetail->identifiers->isbn_13)) {
                    $books[] = $bookDetail;
                }
            }
        }

        if (count($books) > 0) {
            return view('book-search-results')->with([
                'books' => $books
            ]);
        } else {
            // upon further review, those isbn's were linked to books with faulty data
            return back()->with([
                'status' => 'The data for that book is faulty.'
            ]);
        }
    }
}
