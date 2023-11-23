<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{

     /**
     * Display a listing of the author where name mathces the search word
     * This was adapted from a post from Kingcosult on Oct 12 2020 on Dev Community here:
     * https://dev.to/kingsconsult/how-to-implement-search-functionality-in-laravel-8-and-laravel-7-downwards-3g76
     * 
     * @return \Illuminate\Http\Response
     */ 
 public function index(Request $request){
    $authors = Author::where(
        [
            ['name', '!=', Null],
            [
                function ($query) use ($request) {
                    if ($term = $request->term) {
                        $query->orWhere('name', 'LIKE', '%' . $term . '%')->get();
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
        'authors/index',
        [
            'authors' => $authors
        ]
    );
}


  /**
     * Store a newly created author in storage.
     * This was adapted from a youtube tutorial by  Victor Gondalez on freeCodeCamp 
     * youtube channel here:
     * https://www.youtube.com/watch?v=ImtZ5yENzgE&amp;t=2635s
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
 public function store(Request $request){
     $request->validate(
        [
            'name' => 'required',
            'bio' => 'required',
        ]
     );
     auth()->user()->authorsCreated()->create($request->all());
     return redirect()->route('authors.index');
 }
 /**
     * Show the form for creating a new author.
     *
     * @return \Illuminate\Http\Response
     */
 public function create() {
    return view('authors/create');
    }


  /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
 public function show(Author $author) {
    return view('authors.show', [
    'author' => $author
    ]);
    }    


    /**
     * Show the form for editing the specified author.
     *
     * @param  \App\Models\Author  $book
     * @return \Illuminate\Http\Response
     */
 public function edit(Author $author) {
    return view('authors.edit', [
    'author' => $author
     ]);
     }

 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */    
 public function update(Request $request, Author $author) {
    $request->validate([
    'name' => 'required',
    'bio' => 'required'
    ]);
    $author->update($request->all());
    return redirect()->route('authors.index');
    }    

      /**
     * Remove a specified author 
     * from storage.
     * 
     * @param  \App\Models\Author  $book
     * @return \Illuminate\Http\Response
     */
 public function destroy(Author $author) {
    $author->delete();
    return redirect()->route('authors.index')
    ->with('success', 'Auther deleted successfully');
    }    

}