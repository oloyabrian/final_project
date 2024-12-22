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
        if (Auth::check() && (Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())) {
            // User is authenticated and is an admin
            return $next($request);
        }

        return redirect('/app');
    }
}
