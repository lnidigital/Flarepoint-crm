<?php

namespace App\Listeners;

use App\Events\GuestAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Activity;
use Lang;
use App\Models\Task;

class GuestActionLog
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  TaskAction  $event
     * @return void
     */
    public function handle(GuestAction $event)
    {
        /*switch ($event->getAction()) {
            case 'created':
                $text = __(':title was created by :creator', [
                        'title' => $event->getGuest()->title,
                        'creator' => $event->getGuest()->creator->name,
                        'assignee' => $event->getGuest()->user->name
                    ]);
                break;
            case 'updated_status':
                $text = __('Task was completed by :username', [
                        'username' => Auth()->user()->name,
                    ]);
                break;
            case 'updated_time':
                $text = __(':username inserted a new time for this task', [
                        'username' => Auth()->user()->name,
                    ]);
                ;
                break;
            case 'updated_assign':
                $text = __(':username assigned task to :assignee', [
                        'username' => Auth()->user()->name,
                        'assignee' => $event->getGuest()->user->name
                    ]);
                break;
            default:
                break;*/
        }

        $activityinput = array_merge(
            [
                'text' => $text,
                'user_id' => Auth()->id(),
                'source_type' =>  Guest::class,
                'source_id' =>  $event->getGuest()->id,
                'action' => $event->getAction()
            ]
        );
        
        Activity::create($activityinput);
    }
}
