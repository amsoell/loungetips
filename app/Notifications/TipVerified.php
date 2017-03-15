<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Twitter\TwitterChannel;
use NotificationChannels\Twitter\TwitterMessage;

class TipVerified extends Notification {
	use Queueable;

	private $tip;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($tip) {
		$this->tip = $tip;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable) {
		return [TwitterChannel::class];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable) {
		return (new MailMessage)
					->line('The introduction to the notification.')
					->action('Notification Action', url('/'))
					->line('Thank you for using our application!');
	}

	public function toTwitter($notifiable) {
		$templates = [
			'Hey, "%s" is the latest tip of the day! Watch for the rest at loungetips.com',
			'"%s" is the latest lounge tip today. Stick around, there are more coming.',
			'We have a verified tip for you: "%s". Enjoy!',
			'Our crack team of tipsters have a new one for you: "%s." Listen to CD102.5 and see if you can pick up the next tip first!',
			'Your next tip: "%s." We only share one tip each day on TWitter, visit loungetips.com if you want the rest!'
		];

		return new \NotificationChannels\Twitter\TwitterStatusUpdate(sprintf($templates[array_rand($templates)], strtolower($this->tip->tip)));
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable) {
		return [
			//
		];
	}
}
