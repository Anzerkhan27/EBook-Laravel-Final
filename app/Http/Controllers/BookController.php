<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;

class BookController extends Controller
{

    /**
     * Display a listing of the books where title mathces the search word
     * This was adapted from a post from Kingcosult on Oct 12 2020 on Dev Community here:
     * https://dev.to/kingsconsult/how-to-implement-search-functionality-in-laravel-8-and-laravel-7-downwards-3g76
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::where(
            [
                ['title', '!=', Null],
                [
                    function ($query) use ($request) {
                        if ($term = $request->term) {
                            $query->orWhere('title', 'LIKE', '%' . $term . '%')->get();
                        }
                    }
                ]
            ]
        )
            ->orderBy(
                "created_at",
                "desc"
            )
            ->paginate(
                50
            );
        return view(
            'books/index',
            [
                'books' => $books
            ]
        );
    }

    /**
     * Show the form for creating a new book.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if ($id == 0) {
            return view('books.create');
        }
        $author = Author::findorfail($id);
        return view('books.create', compact('author'));
    }

    /**
     * Store a newly created book in storage.
     * This was adapted from a youtube tutorial by  Victor Gondalez on freeCodeCamp 
     * youtube channel here:
     * https://www.youtube.com/watch?v=ImtZ5yENzgE&amp;t=2635s
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $id = $request->author_id;
        $request->validate(
            [
                'title' => 'required',
                'genre' => 'required',
                'description' => 'required',
                'credit_price' => 'required'
            ]
        );
        $book = auth()->user()->booksCreated()->create($request->all());
        if ($id == 0) {
            return redirect()->route('admin.show', compact('user'));
        }
        $author = Author::findorfail($id);
        $author->booksWritten()->save($book);

        return redirect()->route('admin.show', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view(
            'books.show',
            compact('book')
        );
    }

    /**
     * Show the form for editing the specified book.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view(
            'books.edit',
            compact('book')
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate(
            [
                'title' => 'required',
                'genre' => 'required',
                'description' => 'required',
                'credit_price' => 'required'
            ]
        );
        $book->update($request->all());
        $user = Auth::user();
        return redirect()->route('books.show', compact('book'));
    }

    /**
     * Check if the book is not borrowed by any user
     * Remove the specified book from storage.
     * 
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $user = Auth::user();
        if ($book->borrowedBy()->count() == 0) {
            $book->delete();
            return redirect()->route('admin.show', compact('user'))->with('message', 'Book Deleted');
        } else {
            return redirect()->route('admin.show', compact('user'))->with('message', 'Cannot delete until is book is borrowed. You can make the book unavailiable first ');
        }
    }

    /**
     * Borrow the specified book
     * Check if the User has already borrowed the book
     * Attach the book to the bookCreated realationship
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function borrow(Book $book)
    {

        $user = Auth::user();
        if ($user->booksBorrowed->contains($book->id)) {
            return redirect()->back()->with('message', 'Already borrowed');
        }
        if ($book->credit_price > $user->credits) {
            return redirect()->back()->with('message', 'Not enough credits');
        }
        auth()->user()->booksBorrowed()->attach($book->id);
        //Deduct the user credits by the value of book credit price
        User::find($user->id)->decrement('credits', $book->credit_price);
        return redirect()->route('user.books', compact('user'))->with('message', 'Book Borrowed');
    }


    /**
     * Borrow the specified book
     * Check if the User has already borrowed the book
     * Check if the book is overdue 
     * Attach the book to the bookCreated realationship
     * 
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function return(Book $book)
    {

        $user = Auth::user();
        //check if the book is overdue, deduct charges 
        if ($user->getExpiryDate($book->id) < Carbon::now()) {
            User::find($user->id)->decrement('credits', $book->credit_price / 3);
            auth()->user()->booksBorrowed()->detach($book->id);
            return redirect()->route('user.books', compact('user'))->with('message', 'Book Returned. Late fee :' . number_format($book->credit_price / 3, 2) . ' credits deducted');
        } else {
            auth()->user()->booksBorrowed()->detach($book->id);
            return redirect()->route('user.books', compact('user'))->with('message', 'Book Returned');
        }
    }

    /**
     * Update the status of the specified book
     * Check the current status of specified book and toggle the status
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function status(Book $book)
    {

        $user = Auth::user();
        if ($book->status == 'availiable') {
            $book->update(['status' => 'unavailiable']);
        } else {
            $book->update(['status' => 'availiable']);
        }
        return redirect()->route('books.show', compact('book'))->with('message', 'Status Changed');
    }

    /**
     * upload the book content file
     * This was taken from a youtube channel Web TecH Knowledge here:
     * https://www.youtube.com/watch?v=IYswY0Jgup4
     * 
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, Book $book)
    {
        $file = $request->file('file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('assets', $filename);
        $book->file = $filename;
        $book->save();
        return redirect()->route('books.show', compact('book'))->with('message', 'file added');
    }


    /**
     * View the book content file
     * 
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $book = Book::findorfail($id);
        return view('books.view', compact('book'));
    }

    /**
     * Extend the specified book
     * Check if the User has already borrowed the book
     * Re-attach the book to generate a new borrow date
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function extend(Book $book)
    {

        $user = Auth::user();
        $today = Carbon::now();
        $today = Carbon::parse($today)->toDateString();
        //credits charged for extending a book
        $extend_credits = ($book->credit_price / 3);
        //late fee charged for overdue books
        $late_fee = 0;
        //if the expiry/return date is less than current date, add late fee charges to extend credits
        if (auth()->user()->getExpiryDate($book->id) < $today) {
            $late_fee = ($book->credit_price / 3);
            $total_credits = $late_fee + $extend_credits;
        }

        if ($extend_credits < $user->credits) {
            //Add 7 to created_at field of book_user table of current user
            $date = Carbon::parse(($user->booksBorrowed()->findorfail($book->id)->pivot->created_at))->addDays(7);
            $date = Carbon::parse($date)->toDateString();
            //update the new return date    
            $user->booksBorrowed()->updateExistingPivot($book->id, ['created_at' => $date]);
            $total_credits = $late_fee + $extend_credits;
            $total_credits = number_format($total_credits, 2);
            User::find($user->id)->decrement('credits', $extend_credits);

            return redirect()->route('user.books', compact('user'))->with('message', 'Borrowed period extended by 7 days. Extended for: ' . number_format($extend_credits, 2) . ' credits. Extra Charges:  ' . number_format($late_fee, 2) .  ' credits');
        } else {
            return redirect()->route('user.books', compact('user'))->with('message', '  Not enough credits');
        }
    }
}
