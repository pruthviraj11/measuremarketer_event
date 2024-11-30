<?php
// In App\Mail\MessageSent.php
namespace App\Mail;

use App\Models\EventNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageSent extends Mailable
{
    use Queueable, SerializesModels;

    public $notification;

    public function __construct(EventNotification $notification)
    {
        $this->notification = $notification;
    }

    public function build()
    {
        return $this->subject('New Message from ' . $this->notification->sent_by)
            ->view('emails.message_sent')
            ->with([
                'subject' => $this->notification->subject,
                'message' => $this->notification->message,
                'sent_by' => $this->notification->sent_by,
            ]);
    }
}
?>