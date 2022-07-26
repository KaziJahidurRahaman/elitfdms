<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware {

    public function handle($request, Closure $next) {
		
		if (!($request->user()->type == 'admin' || $request->user()->type == 'superadmin')) {
			return redirect('/');
		}
		
		return $next($request);
	}
}
