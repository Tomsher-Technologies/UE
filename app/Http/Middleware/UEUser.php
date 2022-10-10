<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UEUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->isAn('ueuser')) {
            return $next($request);
        }
        return redirect()->route('home')->with('error', 'Permission Denied!!! You do not have administrative access.');
    }
}
