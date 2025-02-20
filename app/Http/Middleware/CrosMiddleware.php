<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CrosMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /* return $next($request)
            ->header("Access-Control-Allow-Origin", "*")
            ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, PATCH, OPTION")
            ->header("Access-Control-Allow-Headers", "Content-Type, Authorization"); */

        // Manejar solicitudes OPTIONS (preflight)
        if ($request->isMethod('OPTIONS')) {
            return response('', 200)
                ->header("Access-Control-Allow-Origin", "*")
                ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, PATCH, OPTIONS")
                ->header("Access-Control-Allow-Headers", "Content-Type, Authorization");
        }

        return $next($request)
            ->header("Access-Control-Allow-Origin", "*")
            ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, PATCH, OPTIONS")
            ->header("Access-Control-Allow-Headers", "Content-Type, Authorization");
    }
}
