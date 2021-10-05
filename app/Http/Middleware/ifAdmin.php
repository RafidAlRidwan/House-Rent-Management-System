<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;

class ifAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->issAdmin())
        {
            return $next($request);
        }

             Session::flash('error', 'You do not have Access!!!');
             return Redirect::route('user_list');
    }

    private function issAdmin(){
        if(Auth::user()->role == 0)
            return true;
        else
            return false;
    }
}
