<?php

namespace App\Http\Middleware;

use App\Models\Membership;
use Closure;
use Illuminate\Http\Request;

class MembershipMiddleware
{
    public function handle(Request $request, Closure $next, Membership $membership)
    {
        if ($membership->user->is(auth()->user())) {
            return $next($request);
        }
        abort(404);
    }
}
