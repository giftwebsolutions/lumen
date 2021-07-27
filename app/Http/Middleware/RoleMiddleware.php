<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role = '')
    {        
        // Get roles
        $roles = array_filter(explode('|',$role));

        if (! empty($roles)) {
        
            // Check User role
            if (! $request->user()->hasRole($roles)) {
                // Error response
                return response('Unauthorized role.', 401);
            }
            
        }

        return $next($request);
    }

}
