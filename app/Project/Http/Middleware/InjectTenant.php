<?php

namespace App\Project\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use App\Mainframe\Features\Core\Traits\SendResponse;

class InjectTenant
{
    use SendResponse;

    /**
     * Check if the request contains a valid X-Auth-Token and client-id
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            /** @var \App\User $user */
            $user = Auth::user();

            if ($user->ofTenant()) {
                $tenantId = $user->tenant_id;

                if (!$request->has('tenant_id')) {
                    request()->merge(['tenant_id' => $tenantId]);
                    // Additional tenant
                }
            }
        }

        return $next($request);
    }

}
