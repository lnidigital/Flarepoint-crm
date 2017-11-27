<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AccessServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\User\UserRepositoryContract::class,
            \App\Repositories\User\UserRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contact\ContactRepositoryContract::class,
            \App\Repositories\Contact\ContactRepository::class
        );
        $this->app->bind(
            \App\Repositories\Role\RoleRepositoryContract::class,
            \App\Repositories\Role\RoleRepository::class
        );
        $this->app->bind(
            \App\Repositories\Group\GroupRepositoryContract::class,
            \App\Repositories\Group\GroupRepository::class
        );
        $this->app->bind(
            \App\Repositories\Setting\SettingRepositoryContract::class,
            \App\Repositories\Setting\SettingRepository::class
        );
        $this->app->bind(
            \App\Repositories\Referral\ReferralRepositoryContract::class,
            \App\Repositories\Referral\ReferralRepository::class
        );
        $this->app->bind(
            \App\Repositories\Onetoone\OnetoOneRepositoryContract::class,
            \App\Repositories\Onetoone\OnetoOneRepository::class
        );
        $this->app->bind(
            \App\Repositories\Meeting\MeetingRepositoryContract::class,
            \App\Repositories\Meeting\MeetingRepository::class
        );
        $this->app->bind(
            \App\Repositories\Revenue\RevenueRepositoryContract::class,
            \App\Repositories\Revenue\RevenueRepository::class
        );
    }
}
