<?php

namespace App\Http\Middleware;

use App\Support\AdminRoles;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! $user || ! $user->hasAnyRole(AdminRoles::adminAccessRoles())) {
            return redirect()->to('/'); // or redirect to home or login
        }

        return $next($request);
    }
}
