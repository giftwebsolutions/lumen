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
		/*
		// Check form input
		if ($request->input('age') <= 200) {
			// Redirect
			return redirect('home');
			// Or redirect to controller
			return redirect()->action('ErrorController@index');
		}
		*/

		$roles = array_filter(explode('|',$role));
		if (! empty($roles)) {
			if (! $request->user()->hasRole($roles)) {
				return response('Unauthorized role.', 401);
			}
		}

		return $next($request);
	}

}
