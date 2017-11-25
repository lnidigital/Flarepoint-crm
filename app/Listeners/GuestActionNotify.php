<?php

namespace App\Listeners;

use App\Events\GuestAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\TaskActionNotification;

class GuestActionNotify
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TaskAction  $event
     * @return void
     */
    public function handle(GuestAction $event)
    {
        /*$guest = $event->getGuest();
        $action = $event->getAction();
        $guest->assignedUser->notify(new GuestActionNotification(
            $guest,
            $action
        ));*/
    }
}
