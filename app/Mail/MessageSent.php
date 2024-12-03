<?php

namespace App\Mail;

use App\Models\EventNotification;
use App\Models\EventRegister;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class MessageSent extends Mailable
{
    use Queueable, SerializesModels;

    public $notification; // The notification object passed to the view

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\EventNotification  $notification
     * @return void
     */
    public function __construct(EventNotification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Pass the necessary data to the view
        return $this->view('message_sent') // The view for the email
            ->with([
                'messageop' => $this->notification->message, // Pass message content to view
                'eventId' => $this->notification->event_id, // Pass event ID to view
                'userId' => $this->notification->company_name,
            ])
            ->subject('New Event Notification');
    }
}
