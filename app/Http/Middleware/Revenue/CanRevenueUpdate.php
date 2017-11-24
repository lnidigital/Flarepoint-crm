<?php

namespace App\Http\Middleware\Revenue;

use Closure;

class CanRevenueUpdate
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
        if (!auth()->user()->can('revenue-update')) {
            Session()->flash('flash_message_warning', 'Not allowed to update revenue!');
            return redirect()->route('revenues.index');
        }

        return $next($request);
    }
}
