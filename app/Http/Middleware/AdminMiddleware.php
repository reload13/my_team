<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        // Check if the user has the "admin" role
        if ($request->user() && $request->user()->hasRole('user')) {
            return $next($request);
        }

        // Redirect or respond with unauthorized message
        return redirect()->route('home')->with('error', 'Unauthorized access.');
    }
}
