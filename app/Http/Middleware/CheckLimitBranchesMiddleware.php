<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLimitBranchesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->customer->getNumberBranchesAvailable()){
            return $next($request);
        }
        return redirect(route('branches.index'));

    }
}
