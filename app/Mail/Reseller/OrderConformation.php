<?php

namespace App\Mail\Reseller;

use App\Models\Orders\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConformation extends Mailable implements ShouldQueue
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
        $subject = 'Your booking has been place';

        return $this->subject($subject)
            ->view('email.admin.newuser')
            ->with('subject', $subject);
    }
}
