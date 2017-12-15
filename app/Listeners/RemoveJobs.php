<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\UserWasBanned;

class RemoveJobs
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function subscribe( $events )
    {
        $events->listen('App\Events\UserWasBanned',
         'App\Listeners\RemoveJobs@handle');
    }

    /**
     * Handle the event.
     *
     * @param  UserWasBanned  $event
     * @return void
     */
    public function handle(UserWasBanned $event)
    {
        $id      = $event->id;
        $company = $event->company; 

        var_dump('Notify ' . $company->name . 'You have been banned from the site.');
    }
}
