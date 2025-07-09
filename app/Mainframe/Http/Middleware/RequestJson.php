<?php

namespace App\Mainframe\Http\Middleware;

use Closure;

class RequestJson
{
    /**
     * Mainframe uses ?ret=json in the request parameter to force a json response
     * from the server. This middleware injects this param.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->get('ret') !== 'json') {
            $request->merge(['ret' => 'json']);
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}
