<?php

namespace App\Http\Middleware\Meeting;

use Closure;

class CanMemberUpdate
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
        if (!auth()->user()->can('member-update')) {
            Session()->flash('flash_message_warning', 'Not allowed to update member!');
            return redirect()->route('members.index');
        }

        return $next($request);
    }
}
