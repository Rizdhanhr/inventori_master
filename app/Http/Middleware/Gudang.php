<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Alert;
use Auth;


class Gudang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()) {
            if(Auth::user()->level == '2'){
                return $next($request);
            }else{
                alert()->error('Anda Tidak Memiliki Akses');
                return redirect('/dashboard');
            }
        }else{
            alert()->error('Silahkan Login!');
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
