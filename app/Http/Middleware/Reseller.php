<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Reseller
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
        if (auth()->user()->isA('reseller')) {
            return $next($request);
        }

        if (auth()->user()->isAn('admin')) {
            return redirect()->route('admin.dashboard');
        }

        return redirect('/')->with('error', 'Permission Denied!!! You do not have administrative access.');
    }
}
