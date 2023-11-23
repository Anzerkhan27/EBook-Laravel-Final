<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class bookCheckMiddleware
{
     /**
     * Custom middleware to check if a user borrows the 
     * specified book or not
     * This was adapted from a youtube tutorial from Cambo tutorial here:
     * https://www.youtube.com/watch?v=vc4sXOdE4bQ
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param   $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,){

        $id = $request->route('id');
        if(Auth::check() && Auth::user()->booksBorrowed->contains($id) ){
            return $next($request);
        }else{
            abort(403, 'Unauthorized action.');
        }
    }
}
