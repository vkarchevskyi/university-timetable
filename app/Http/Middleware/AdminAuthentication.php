<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // For now, we'll allow all requests to the admin area
        // In production, you would add proper authentication logic here
        // For example:
        // if (!auth()->check() || !auth()->user()->isAdmin()) {
        //     return redirect()->route('login');
        // }

        return $next($request);
    }
}
