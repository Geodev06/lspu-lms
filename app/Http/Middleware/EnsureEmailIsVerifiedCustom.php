<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerifiedCustom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || !$user->hasVerifiedEmail()) {
            // If request expects JSON (like Livewire), return redirect response manually
            if ($request->expectsJson() || $request->header('X-Livewire')) {
                return response()->json([
                    'redirect' => route('verification.notice')
                ], 409); // 409 Conflict can signal frontend to redirect
            }

            // Otherwise, perform a normal redirect
            return redirect()->route('verification.notice');
        }

        return $next($request);
    }
}
