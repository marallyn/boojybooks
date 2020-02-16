<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    /**
     * Limit list functionality to those logged in
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Adds a book to the user's list
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        // try to find an existing entry for this book on the list
        $listEntry = BookUser::where('user_id', Auth::user()->id)
            ->leftJoin('books', 'books.id', '=', 'book_users.book_id')
            ->where('books.isbn', $request->isbn)
            ->first();

        if ($listEntry) {
            // the user already saved this book
            return back()->with([
                'color' => 'warning',
                'status' => 'I was gonna save that book for you, but it is already on your list.'
            ]);
        } else {
            $book = Book::create([
                'author' => $request->author ?? '',
                'cover' => $request->cover ?? '',
                'isbn' => $request->isbn,
                'pages' => \intval($request->pages),
                'title' => $request->title ?? ''
            ]);

            $listEntry = BookUser::create([
                'book_id' => $book->id,
                'user_id' => Auth::user()->id,
                'rank' => Auth::user()->numBooks + 1
            ]);
    
            return redirect()->route('list')->with([
                'status' => "$request->title added to your list"
            ]);
        }
    }

    /**
     * Displays all the books in the user's list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('list')->with([
            'books' => Auth::user()->list
        ]);
    }

    /**
     * Moves the given book lower in rank order
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function moveDown(int $id)
    {
        // find the list entry for the given bookId
        $listEntry = BookUser::select('book_users.*')
            ->where('user_id', Auth::user()->id)
            ->leftJoin('books', 'books.id', '=', 'book_users.book_id')
            ->where('books.id', $id)
            ->first();

        $rank = $listEntry->rank;
        
        if ($rank < Auth::user()->numBooks) {
            // move the book that is lower on the list up the list
            BookUser::where('user_id', Auth::user()->id)
                ->where('rank', $rank + 1)
                ->decrement('rank');

            // move the given book down the list
            $listEntry->rank = $rank + 1;
            $listEntry->save();

            return redirect()->route('list');
        } else {
            return back()->with([
                'color' => 'warning',
                'status' => "That book is already your least favorite, so the next step would be to remove it. You just say the word, and I can make it happen."
            ]);
        }
    }

    /**
     * Moves the given book higher in rank order
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function moveUp(int $id)
    {
        // find the list entry for the given bookId
        $listEntry = BookUser::select('book_users.*')
            ->where('user_id', Auth::user()->id)
            ->leftJoin('books', 'books.id', '=', 'book_users.book_id')
            ->where('books.id', $id)
            ->first();

        $rank = $listEntry->rank;
        
        if ($rank > 1) {
            // move the book that is ahead on the list down the list
            BookUser::where('user_id', Auth::user()->id)
                ->where('rank', $rank - 1)
                ->increment('rank');

            // move the given book up the list
            $listEntry->rank = $rank - 1;
            $listEntry->save();

            return redirect()->route('list');
        } else {
            return back()->with([
                'color' => 'warning',
                'status' => "That books is already your favorite, I can't rank it any higher"
            ]);
        }
    }

    /**
     * Removes a book from the user's list
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        // find and delete the list entry
        $listEntry = BookUser::select('book_users.*')
            ->where('user_id', Auth::user()->id)
            ->leftJoin('books', 'books.id', '=', 'book_users.book_id')
            ->where('books.id', $request->id)
            ->first();
        $listEntry->delete();

        // delete the book entry
        Book::where('id', $request->id)
            ->delete();

        // update the rank of the remaining books
        BookUser::where('user_id', Auth::user()->id)
            ->where('rank', '>', $listEntry->rank)
            ->decrement('rank');

   
        return redirect()->route('list');
    }

}
