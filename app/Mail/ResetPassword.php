<?php

namespace App\Mail;

use App\Models\EventNotification;
use App\Models\EventRegister;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // The notification object passed to the view
    public $randomPassword;


    /**
     * Create a new message instance.
     *
     * @param  \App\Models\EventRegister  $user
     * @return void
     */
    public function __construct(EventRegister $user, $randomPassword)
    {
        $this->user = $user;
        $this->randomPassword = $randomPassword;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Pass the necessary data to the view
        return $this->view('reset_password') // The view for the email
            ->with([
                'fullname' => $this->user->full_name,
                'company_name' => $this->user->company_name,
                'contact_person' => $this->user->contact_person,
                'form_type' => $this->user->form_type,
                'email' => $this->user->email,
                'password' => $this->randomPassword,

            ])
            ->subject('Reset Password');
    }
}
