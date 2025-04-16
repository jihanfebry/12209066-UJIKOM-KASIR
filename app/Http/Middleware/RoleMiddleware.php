<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {

        if(!auth()->check()){
            return redirect()->route('login')->with('failed', 'Silakan login terlebih dahulu');
        }

        $user = auth()->user();

        if($user->role !==$role){
            return abort(403, 'Unauthorized');
        }
        
        return $next($request);
    }
}
