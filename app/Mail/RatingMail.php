<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RatingMail extends Mailable
{
    use Queueable, SerializesModels;
    public $token, $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, Order $order)
    {
        $this->token = $token;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->order->user_email, $this->order->user_name)
                    ->bcc($this->order->user_email)
                    ->subject('Rate Your Order - [#ZS'.$this->order->id.'] | '.config('app.name'))
                    ->view('emails.orders.rating')
                    ->with([
                        'order' => $this->order,
                        'token' => $this->token,
                    ]);
    }
}
