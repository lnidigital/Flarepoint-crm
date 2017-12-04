<?php

namespace App\Http\Middleware;

use Closure;
use View;
use App\Repositories\Group\GroupRepository;
use Illuminate\Support\Facades\Log;

class CheckSession
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
        if (count($request->user()->groups) == 1)
            session(['user_group_id'=>$request->user()->groups[0]->id]);
        
        if (session('user_group_id') != null)
            $selectedGroup = session('user_group_id');
          else 
            $selectedGroup = null;

        if (\Auth::check()) {
            $groups = new GroupRepository();
            Log::info('CheckSession->handle->user_id: '.$request->user()->id);
            $userGroups = $groups->getAllGroupsByUser($request->user()->id); //Auth::user()->id
            View::share('groups', $userGroups);
            View::share('selectedGroup', $selectedGroup);
        }

        return $next($request);
    }
}
