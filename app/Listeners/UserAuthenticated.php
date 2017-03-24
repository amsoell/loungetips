<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Authenticated;

class UserAuthenticated {

	/**
	 * Handle the event.
	 *
	 * @param  OrderShipped  $event
	 * @return void
	 */
	public function handle(Authenticated $event) {
		$event->user->update(['seen_at' => Carbon::now()]);
	}
}
