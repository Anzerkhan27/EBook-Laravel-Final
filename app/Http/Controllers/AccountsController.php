<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AccountsController extends Controller
{

  public function index(Request $request)
  {
     
      $users = User::where(
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
     
        return view('user.index', compact('users'));
  }
  
/**
     * Show the account page of a specified admin.
     * Restric an admin from only be able to see their account
     * This was adapted from an anwser from ZeroOne on Apr 18 2018 posted on StackOverflow here:
     * https://stackoverflow.com/questions/49951125/laravel-restrict-users-to-only-be-able-to-see-their-own-profile
     * 
     * @param  $user
     * @return \Illuminate\Http\Response
     */   
  public function adminAccount($user)
    {
      $user = User::findorfail($user);
      // valid user
      if(Auth::id() == $user->id) {
      $user = Auth::user();
      return view('admin.index', compact('user')  );
     }else {
       abort(403, 'Unauthorized action.');
   }
    }

  /**
     * Show the account page of a specified user.
     * Restric a user from only be able to see their account
     * This was adapted from an anwser from ZeroOne on Apr 18 2018 posted on StackOverflow here:
     * https://stackoverflow.com/questions/49951125/laravel-restrict-users-to-only-be-able-to-see-their-own-profile
     * 
     * @param  $user
     * @return \Illuminate\Http\Response
     */  
    public function userAccount($user)
    {
      $user = User::findorfail($user);
      // valid user
      if(Auth::id() == $user->id) {
      $user = Auth::user();
      return view('user.show', compact('user')  );
     }else {
       abort(403, 'Unauthorized action.');
   }
    }

  /**
     * Show the books borrowed by the  user.
     * 
     * @param  $user
     * @return \Illuminate\Http\Response
     */  
    public function myBooks($user)
    {
      $user = User::findorfail($user);
      // valid user
      if(Auth::id() == $user->id) {
      $user = Auth::user();
      return view('user.books', compact('user')  );
     }else {
       abort(403, 'Unauthorized action.');
   }
    }
  
    /**
     * Show the page for buying credits for the authenticated.
     * 
     * @param  $user
     * @return \Illuminate\Http\Response
     */  
    public function myCredits($user)
    {
      $user = User::findorfail($user);
      if(Auth::id() == $user->id) {
      $user = Auth::user();
      return view('user.credits', compact('user')  );
     }else {
       abort(403, 'Unauthorized action.');
   }
    }

    /**
     * Tempory method inplace of payment integration.
     * Add 100 credits to the autthencated user;
     * 
     * @param  $user
     * @return \Illuminate\Http\Response
     */      
    public function buyCredits($user)
    {
      $user = User::findorfail($user);
      if(Auth::id() == $user->id) {
      $user = Auth::user();
      User::find($user->id)->increment('credits',100);
      return redirect()->route('user.credits', compact('user'))->with('message', 'Congratultaions you have bought 100 credits');
     } else {
       abort(403, 'Unauthorized action.');
   }
    }
 
     /**
     * Update the role of the user
     * Check the current role of user & change to admin
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function makeAdmin(User $user){
      $user->booksBorrowed()->detach();
      if($user->role == 'user'){
      $user->update(['role' => 'admin']);
      }
      else{
      return redirect()->route('users.index')->with('message', 'Already an admin');
      }  
      return redirect()->route('users.index')->with('message', 'New admin created');
 
 }
 
 
  


}

