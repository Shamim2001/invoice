<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable {
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
        $invoice = $this->data['invoice'];
        $client = $this->data['invoice']->client;
        $invoice_id = $this->data['invoice_id'];
        $pdf = $this->data['pdf'];

        return $this->markdown( 'emails.invoice' )
            ->from( $user->email, $user->name )
            ->to( $client->email, $client->name )
            ->subject( $invoice_id )
            ->attachData( $pdf, $invoice->download_url, ['mime' => 'application/pdf'] );
    }
}
