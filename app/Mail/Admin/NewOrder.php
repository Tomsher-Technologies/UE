<?php

namespace App\Mail\Admin;

use App\Models\Orders\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public User $user;
    public Order $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'You have received a new booking';

        return $this->subject($subject)
            ->view('email.admin.neworder')
            ->with('subject', $subject);
    }
}
