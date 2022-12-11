<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Order;
use App\Events\OrderCreated;
use App\Notifications\NewOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderCreatedNotifications implements ShouldQueue
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

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        // auth()->user->notify(new NewOrder($event->order));

        // foreach (User::whereNot('id', $event->chirp->user_id)->cursor() as $user) {
        //     $user->notify(new NewChirp($event->chirp));
        // }

        $user = User::where('id', auth()->user->id)->cursor();
        $user->notify(new NewOrder($event->order));
    }
}
