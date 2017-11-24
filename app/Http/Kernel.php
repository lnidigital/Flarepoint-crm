<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \App\Http\Middleware\LogLastUserActivity::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ],
        'meeting.create' => [ \App\Http\Middleware\Meeting\CanMeetingCreate::class ],
        'meeting.update' => [ \App\Http\Middleware\Meeting\CanMeetingUpdate::class ],
        'guest.create' => [ \App\Http\Middleware\Guest\CanGuestCreate::class ],
        'guest.update' => [ \App\Http\Middleware\Guest\CanGuestUpdate::class ],
        'referral.create' => [ \App\Http\Middleware\Referral\CanReferralCreate::class ],
        'referral.update' => [ \App\Http\Middleware\Referral\CanReferralUpdate::class ],
        'revenue.create' => [ \App\Http\Middleware\Revenue\CanRevenueCreate::class ],
        'revenue.update' => [ \App\Http\Middleware\Revenue\CanRevenueUpdate::class ],
        'onetoone.create' => [ \App\Http\Middleware\OnetoOne\CanOnetoOneCreate::class ],
        'onetoone.update' => [ \App\Http\Middleware\OnetoOne\CanOnetoOneUpdate::class ],
        'member.create' => [ \App\Http\Middleware\Member\CanMemberCreate::class ],
        'member.update' => [ \App\Http\Middleware\Member\CanMemberUpdate::class ],
        'group.create' => [ \App\Http\Middleware\Group\CanGroupCreate::class ],
        'group.update' => [ \App\Http\Middleware\Group\CanGroupUpdate::class ],

        'client.create' => [ \App\Http\Middleware\Client\CanClientCreate::class ],
        'client.update' => [ \App\Http\Middleware\Client\CanClientUpdate::class ],
        'user.create' => [ \App\Http\Middleware\User\CanUserCreate::class ],
        'user.update' => [ \App\Http\Middleware\User\CanUserUpdate::class ],
        'task.create' => [ \App\Http\Middleware\Task\CanTaskCreate::class ],
        'task.update.status' => [ \App\Http\Middleware\Task\CanTaskUpdateStatus::class ],
        'task.assigned' => [ \App\Http\Middleware\Task\IsTaskAssigned::class ],
        'lead.create' => [ \App\Http\Middleware\Lead\CanLeadCreate::class ],
        'lead.assigned' => [ \App\Http\Middleware\Lead\IsLeadAssigned::class ],
        'lead.update.status' => [ \App\Http\Middleware\Lead\CanLeadUpdateStatus::class ],
        'user.is.admin' => [ \App\Http\Middleware\RedirectIfNotAdmin::class ],
        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}
