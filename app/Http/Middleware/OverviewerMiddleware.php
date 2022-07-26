<?php

namespace App\Http\Middleware;

use Closure;

class OverviewerMiddleware {

    public function handle($request, Closure $next) {
		
		if (!($request->user()->type == 'overviewer')) {
			return redirect('/');
		}
		
		return $next($request);
	}
}
