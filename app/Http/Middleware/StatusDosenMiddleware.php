<?php

namespace App\Http\Middleware;

use Closure;

class StatusDosenMiddleware
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
      $User = $request->user();

      if ($User){
        if (($User->isDosen()) && ($User->isStatusDosen())){
          return $next($request);
      }
        return abort(404);
      }
    }
}
