<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch(\Auth::user()->user_role) {
                case 0:
                    return redirect('admin');
                    break;
                case 1:
                    return redirect('recept');
                    break;
                case 2:
                    return redirect('doctor');
                    break;
                case 3:
                    return redirect('nurse');
                    break;
                case 4:
                    return redirect('lab');
                    break;
                case 5:
                    return redirect('pharmacy');
                    break;
                default:
                    return redirect()->back()->with('failed', ['You are not a system user']); 
            }
        }
        return $next($request);
    }
}
