<?php
namespace App\Providers;

use App\Models\User;
use Illuminate\Support\BaseServiceProvider;

class RouteBindingServiceProvider extends BaseServiceProvider
{
	public function boot(): void
	{
		$binder = $this->binder;
		$binder->implicitBind('App\Models',);
		
		$binder->bind('id', function($id) {
            // ...
        }
	}
}
