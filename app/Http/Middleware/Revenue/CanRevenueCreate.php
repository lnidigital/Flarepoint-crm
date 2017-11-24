<?php

namespace App\Http\Middleware\Revenue;

use Closure;

class CanRevenueCreate
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
        if (!auth()->user()->can('revenue-create')) {
            Session()->flash('flash_message_warning', 'Not allowed to create revenue!');
            return redirect()->route('revenues.index');
        }

        return $next($request);
    }
}
