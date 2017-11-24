<?php

namespace App\Http\Middleware\Onetoone;

use Closure;

class CanOnetoOneUpdate
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
        if (!auth()->user()->can('onetoone-update')) {
            Session()->flash('flash_message_warning', 'Not allowed to update 1-to-1!');
            return redirect()->route('onetoones.index');
        }

        return $next($request);
    }
}
