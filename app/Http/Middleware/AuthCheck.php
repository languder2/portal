<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\{Notification, Token};

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(!auth()->check())
            return redirect()->route('home');

        Token::where('lifetime', '<', now())->delete();

        Notification::where('lifetime', '<', now())->delete();

        return $next($request);
    }
}
