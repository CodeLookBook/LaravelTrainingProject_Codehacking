<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){                  /*залогинен ли пользователь?*/
            if(Auth::user()->isAdmin()){    /*пользователь администратор?*/
                return $next($request);
            }
        }

        return redirect('/');
    }
}
