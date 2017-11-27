<?php

namespace App\Http\Middleware\Attendance;

use Closure;

class CanAttendanceUpdate
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
        if (!auth()->user()->can('attendance-update')) {
            Session()->flash('flash_message_warning', 'Not allowed to update attendance!');
            return redirect()->route('attendance.index');
        }

        return $next($request);
    }
}
