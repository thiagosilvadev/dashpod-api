<?php

namespace App\Http\Middleware;

use App\Models\Membership;
use Closure;
use Illuminate\Http\Request;

class MembershipMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        /**
         * @var Membership $membership
         */
        $membership = $request->route('membership');
        if (is_string($membership)) {
            $membership = Membership::find($request->route('membership'));
        }
        if ($membership?->user->is(auth()->user())) {
            return $next($request);
        }
        abort(404);
    }
}
