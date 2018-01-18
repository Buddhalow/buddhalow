<?php
namespace App\Http\Middleware;

use Closure;

class ForceHttpsProtocol {

    public function handle($request, Closure $next)
    {
            if ($request->server('HTTP_X_FORWARDED_PROTO') != 'https') {
                return redirect()->secure($request->getRequestUri());
            }

            return $next($request); 
    }
}