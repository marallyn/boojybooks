<?php

namespace App\Http\Controllers;

use App\Book;
use App\Traits\OpenLibrary;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use OpenLibrary;

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $book = Book::with('listDetails')->find($id);

        $bookDetail = $this->bookDetail($book->isbn);
// dd($bookDetail);
        return view('book-detail')->with([
            'book' => $book,
            'details' => $bookDetail
        ]);
    }

}
