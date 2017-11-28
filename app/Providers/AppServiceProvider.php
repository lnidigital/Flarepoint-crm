<?php

namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;
use App\Repositories\Group\GroupRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->user = Auth::user();

        //Log::info('userid='.$this->user->id);
        // $groups = new GroupRepository();
        // $userGroups = $groups->getAllGroups(Auth::user()->id);

        // if (session('user_group_id') != null)
        //     $selectedGroup = session('user_group_id');
        //   else 
        //     $selectedGroup = null;

        // View::share('groups', $userGroups);
        // Log::info('selectedGroup='.$selectedGroup);
        // View::share('selectedGroup', $selectedGroup);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
