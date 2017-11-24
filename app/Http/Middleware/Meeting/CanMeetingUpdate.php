<?php

namespace App\Http\Middleware\Meeting;

use Closure;

class CanMeetingUpdate
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
        if (!auth()->user()->can('meeting-update')) {
            Session()->flash('flash_message_warning', 'Not allowed to update meeting');
            return redirect()->route('meetings.index');
        }
        return $next($request);
    }
}
