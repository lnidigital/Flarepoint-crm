<?php

namespace App\Http\Middleware\Attendance;

use Closure;

class CanAttendanceCreate
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
        if (!auth()->user()->can('attendance-create')) {
            Session()->flash('flash_message_warning', 'Not allowed to create attendance!');
            return redirect()->route('attendance.index');
        }

        return $next($request);
    }
}
