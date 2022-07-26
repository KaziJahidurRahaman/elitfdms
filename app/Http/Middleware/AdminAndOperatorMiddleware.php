<?php

namespace App\Http\Middleware;

use Closure;

class AdminAndOperatorMiddleware {

    public function handle($request, Closure $next) {
		
		if (!($request->user()->type == 'admin' || $request->user()->type == 'superadmin' || $request->user()->type == 'huboperator')) {
			return redirect('/');
		}
		
		return $next($request);
	}
}
