<?php

namespace App\Http\Middleware\Guest;

use Closure;

class CanGuestCreate
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
        if (!auth()->user()->can('guest-create')) {
            Session()->flash('flash_message_warning', 'Not allowed to create guest!');
            return redirect()->route('guests.index');
        }

        return $next($request);
    }
}
