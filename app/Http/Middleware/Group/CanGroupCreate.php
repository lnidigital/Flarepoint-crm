<?php

namespace App\Http\Middleware\Group;

use Closure;

class CanGroupCreate
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
        if (!auth()->user()->can('group-create')) {
            Session()->flash('flash_message_warning', 'Not allowed to create group!');
            return redirect()->route('groups.index');
        }

        return $next($request);
    }
}
