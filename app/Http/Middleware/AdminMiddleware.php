<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Gate::allows('isAdmin', Auth::user())) {
            foreach(User::where('type', 'member')->get() as $user) {
                if (floor(Carbon::now()->diffInMonths(Carbon::parse($user->membership_end_at))) < $user->membership_duration) {
                    $user->membership_duration = floor(Carbon::now()->diffInMonths(Carbon::parse($user->membership_end_at)));
                    $user->save();
                }
                if (floor(Carbon::now()->gt(Carbon::parse($user->membership_end_at)))) {
                    $user->activated = 0;
                    $user->membership_duration = 0;
                    $user->save();
                }
            }

            return $next($request);
        }

        return abort(403);
    }
}
