<?php

namespace App\Http\Middleware\Group;

use Closure;

class CanGroupUpdate
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
        if (!auth()->user()->can('group-update')) {
            Session()->flash('flash_message_warning', 'Not allowed to update group!');
            return redirect()->route('groups.index');
        }

        return $next($request);
    }
}
