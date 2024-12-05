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
    public $companyName;

    public $eventName;


    /**
     * Create a new message instance.
     *
     * @param  \App\Models\EventNotification  $notification
     * @return void
     */
    public function __construct(EventNotification $notification, $companyName, $eventName)
    {
        $this->notification = $notification;
        $this->eventName = $eventName;
        $this->companyName = $companyName;

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
                'eventId' => $this->eventName, // Pass event ID to view
                'companyName' => $this->companyName, // Pass company name to view

            ])
            ->subject('New Event Notification');
    }
}
