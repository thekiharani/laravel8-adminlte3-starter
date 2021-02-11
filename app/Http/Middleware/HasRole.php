<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(!$request->user()->hasRole($role)) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'unauthorized'], Response::HTTP_FORBIDDEN);
            }
             abort(403, 'You are not authorized to access this page');
        }
        return $next($request);
    }
}
