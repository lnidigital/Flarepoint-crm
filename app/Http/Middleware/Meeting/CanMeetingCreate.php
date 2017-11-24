<?php

namespace App\Http\Middleware\Meeting;

use Closure;

class CanMeetingCreate
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
        if (!auth()->user()->can('meeting-create')) {
            Session()->flash('flash_message_warning', 'Not allowed to create meeting!');
            return redirect()->route('meetings.index');
        }

        return $next($request);
    }
}
