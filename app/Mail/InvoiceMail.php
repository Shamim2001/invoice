<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable implements ShouldQueue {
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $data ) {

        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {

        $user = $this->data['user'];
        $client = $this->data['invoice']->client;
        $invoice_id = $this->data['invoice_id'];
        $pdf = $this->data['pdf'];

        return $this->markdown( 'emails.invoice', ['client' => $client] )
            ->replyTo( $user->email, $user->name )
            ->from( env( 'MAIL_FROM_ADDRESS' ), $user->name )
            ->subject( $invoice_id )
            ->attach( $pdf, ['mime' => 'application/pdf'] );
    }
}
