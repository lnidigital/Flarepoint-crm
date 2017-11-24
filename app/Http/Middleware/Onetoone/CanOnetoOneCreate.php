<?php

namespace App\Http\Middleware\Onetoone;

use Closure;

class CanOnetoOneCreate
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
        if (!auth()->user()->can('onetoone-create')) {
            Session()->flash('flash_message_warning', 'Not allowed to create 1-to-1!');
            return redirect()->route('onetoones.index');
        }

        return $next($request);
    }
}
