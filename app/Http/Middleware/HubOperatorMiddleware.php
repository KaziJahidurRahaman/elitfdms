<?php

namespace App\Http\Middleware;

use Closure;

class HubOperatorMiddleware {

    public function handle($request, Closure $next) {
		
		if (!($request->user()->type == 'huboperator')) {
			return redirect('/');
		}
		
		return $next($request);
	}
}
