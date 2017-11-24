<?php

namespace App\Http\Middleware\Referral;

use Closure;

class CanReferralUpdate
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
        if (!auth()->user()->can('referral-update')) {
            Session()->flash('flash_message_warning', 'Not allowed to update referral!');
            return redirect()->route('referrals.index');
        }

        return $next($request);
    }
}
