<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotSuper
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
        if (!auth()->user()->hasRole('super')) {
            Session()->flash('flash_message_warning', 'Only Allowed for super users');
            return redirect()->back();
        }
        return $next($request);
    }
}
