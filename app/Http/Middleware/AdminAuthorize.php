<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthorize
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
        $user = $request->user();
        if (!$user or !$user->isRoot) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
