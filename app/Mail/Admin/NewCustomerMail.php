<?php

namespace App\Mail\Admin;

use App\Models\Common\Settings;
use App\Models\Customer\CustomerDetails;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class NewCustomerMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public User $user;
    public CustomerDetails $userDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->userDetails = $user->customerDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'A new user has registered on your site';

        return $this->subject($subject)
            ->view('email.admin.newuser')
            ->with('subject', $subject);
    }
}
