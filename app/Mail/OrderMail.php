<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->bcc($this->order->user_email, $this->order->user_name)
                    ->bcc('contact@ziksales.co')
                    ->subject('Order Confirmation - [#ZS'.$this->order->id.'] | Ziksales')
                    ->view('emails.orders.placed')
                    ->with([
                        'order' => $this->order,
                    ]);
    }
}
