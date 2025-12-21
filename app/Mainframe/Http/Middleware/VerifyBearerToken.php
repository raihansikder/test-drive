<?php

namespace App\Mainframe\Http\Middleware;

use App\Mainframe\Features\Core\Traits\SendResponse;
use Auth;
use Closure;

class VerifyBearerToken
{
    use SendResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Auth::logout(); // Force to discard any user state.

        if (! $user = Auth::guard('bearer')->user()) {
            return $this->failed('Authentication failed (Bearer)', 401);
        }

        // Email not verified
        if (! $user->email_verified_at) {
            return $this->failed('Email not verified or user is not active.', 401);
        }

        // Onetime login for Api
        if ($user->id) {
            Auth::onceUsingId($user->id);
        }

        return $next($request);
    }
}
