<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserLevelMiddleware
{
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        if (Auth::check() && in_array(Auth::user()->level, $levels)) {
            return $next($request);
        }

        //abort(403, 'Unauthorized.');
        return response()->view('errors.403'); // Create a 403.blade.php
    }
}