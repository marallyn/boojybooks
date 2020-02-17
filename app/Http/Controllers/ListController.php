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
        $book = Book::with('listDetails')->find($id);
        $rank = $book->listDetails->rank;
        
        if ($rank < Auth::user()->numBooks) {
            // book can be moved lower
            // move the book that is lower on the list up the list
            BookUser::where('user_id', Auth::user()->id)
                ->where('rank', $rank + 1)
                ->decrement('rank');

            // move the given book down the list
            BookUser::where('id', $book->listDetails->id)
                ->increment('rank');

            return redirect()->route('list');
        } else {
            return back()->with([
                'color' => 'warning',
                'status' => "'$book->title' is already your least favorite, so the next step would be to remove it. You just say the word, and I can make it happen."
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
        $book = Book::with('listDetails')->find($id);
        $rank = $book->listDetails->rank;
        
        if ($rank > 1) {
            // move the book that is ahead on the list down the list
            BookUser::where('user_id', Auth::user()->id)
                ->where('rank', $rank - 1)
                ->increment('rank');

            // move the given book up the list
            BookUser::where('id', $book->listDetails->id)
                ->decrement('rank');

            return redirect()->route('list');
        } else {
            return back()->with([
                'color' => 'warning',
                'status' => "'$book->title' is already your favorite, I can't rank it any higher"
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
        $book = Book::with('listDetails')->find($request->id);

        // delete the list entry
        BookUser::where('id', $book->listDetails->id)->delete();

        // delete the book entry
        $book->delete();

        // update the rank of the remaining books that are lower in rank
        BookUser::where('user_id', Auth::user()->id)
            ->where('rank', '>', $book->listDetails->rank)
            ->decrement('rank');

   
        return redirect()->route('list');
    }

}
