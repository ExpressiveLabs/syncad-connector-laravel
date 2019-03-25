<?php

  namespace mainstreamct\SyncadConnectorLaravel;

  use Closure;

  class syncadGuard
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
      if($request->key === config('syncad.key')) {
        return $next($request);
      }
    }
  }