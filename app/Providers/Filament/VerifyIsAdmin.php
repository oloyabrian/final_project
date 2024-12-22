<?php

namespace App\Providers\Filament;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || (!Auth::user()->isSuperAdmin() && !Auth::user()->isAdmin())) {
            // Redirect or abort if the user is not an admin
            return redirect('/app/login'); // Or use abort(403);
        }

        return $next($request);
    }
}
