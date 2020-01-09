<?php

namespace App\Http\Middleware;

use App\Models\Trust\Role;
use Closure;

class ScopeByRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = currentUser();
        switch (true) {
            case $user->hasRole(Role::MEMBER):
                return $next($request);
            case $user->hasRole(Role::SUPER_ADMIN):
                return $next($request);
            default:
                return $next($request);
        }
    }
}
