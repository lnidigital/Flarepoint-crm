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
        'referral.create' => [ \App\Http\Middleware\Referral\CanReferralCreate::class ],
        'referral.update' => [ \App\Http\Middleware\Referral\CanReferralUpdate::class ],
        'revenue.create' => [ \App\Http\Middleware\Revenue\CanRevenueCreate::class ],
        'revenue.update' => [ \App\Http\Middleware\Revenue\CanRevenueUpdate::class ],
        'onetoone.create' => [ \App\Http\Middleware\OnetoOne\CanOnetoOneCreate::class ],
        'onetoone.update' => [ \App\Http\Middleware\OnetoOne\CanOnetoOneUpdate::class ],
        'contact.create' => [ \App\Http\Middleware\Contact\CanContactCreate::class ],
        'contact.update' => [ \App\Http\Middleware\Contact\CanContactUpdate::class ],
        'group.create' => [ \App\Http\Middleware\Group\CanGroupCreate::class ],
        'group.update' => [ \App\Http\Middleware\Group\CanGroupUpdate::class ],
        'attendance.create' => [ \App\Http\Middleware\Attendance\CanAttendanceCreate::class ],
        'attendance.update' => [ \App\Http\Middleware\Attendance\CanAttendanceUpdate::class ],
        'organization.create' => [ \App\Http\Middleware\Organization\CanOrganizationCreate::class ],
        'organization.update' => [ \App\Http\Middleware\Organization\CanOrganizationUpdate::class ],
        'user.create' => [ \App\Http\Middleware\User\CanUserCreate::class ],
        'user.update' => [ \App\Http\Middleware\User\CanUserUpdate::class ],
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
