<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateStripeAccount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $response = app('stripe')->accounts->create(['type' => 'standard']);

        $event->user->update([
            'stripe_account_id' => $response->id,
        ]);
    }
}
