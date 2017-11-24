<?php

namespace App\Http\Middleware\Member;

use Closure;

class CanMemberCreate
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
        if (!auth()->user()->can('member-create')) {
            Session()->flash('flash_message_warning', 'Not allowed to create member!');
            return redirect()->route('members.index');
        }

        return $next($request);
    }
}
