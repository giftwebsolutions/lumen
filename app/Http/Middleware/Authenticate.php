<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Auth\GenericUser;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request, validate user privileges.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            // Error response        
            return response('Unauthorized.', 401);
        }       
        
        /*
        // Check form input
        if ($request->input('age') <= 200) { 
            // Redirect
            return redirect('home');
            
            // Or redirect to controller
            return redirect()->action('ErrorController@index');
        }
        */
        
        /*
        // Check logged User role see: RoleMiddleware.php
        if (! $request->user()->hasRole(['user','admin','worker'])) {
            // Error response
            return response('Unauthorized role.', 401);
        }
        */

        return $next($request);
    }
}
