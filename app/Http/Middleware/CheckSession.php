<?php

namespace App\Http\Middleware;

use Closure;
use View;
use App\Repositories\Group\GroupRepository;

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
        
        if (session('user_group_id') != null)
            $selectedGroup = session('user_group_id');
          else 
            $selectedGroup = null;

        if (\Auth::check()) {
            $groups = new GroupRepository();
            $userGroups = $groups->getAllGroups($request->user()->id); //Auth::user()->id
            View::share('groups', $userGroups);
            View::share('selectedGroup', $selectedGroup);
        }

        return $next($request);
    }
}
