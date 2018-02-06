<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class AdminUIAuth {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Session::get('admin')) {
            $request['admin'] = Session::get('admin');
            return $next($request);
        } else {
            Session::flash('message', \Illuminate\Support\Facades\Lang::get('api_error.admin_login'));
            return redirect()->route('admin_login');
        }
    }

}
