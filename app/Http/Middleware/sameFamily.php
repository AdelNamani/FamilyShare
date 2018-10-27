<?php

namespace App\Http\Middleware;

use Closure;

class sameFamily
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (isset($request->id_Family)){
            if ($request->id_Family!=auth('api')->user()->id_family) return json_encode(['error'=>'Not authenticated']);
        }
        return $next($request);
    }
}
