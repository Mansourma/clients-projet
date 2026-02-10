<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NonSubscribedToDoNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $serviceName;
    public $invoicePath;
    public $companyName;



    /**
     * Create a new message instance.
     *
     * @param string $clientName
     * @param string $serviceName
     * @param string $invoicePath
     * @return void
     */
    public function __construct($clientName, $serviceName, $invoicePath)
    {
        $this->clientName = $clientName;
        $this->serviceName = $serviceName;
        $this->invoicePath = $invoicePath;
        $this->companyName = 'Ryd MEDIATECH';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Service Scheduled Notification - ' . $this->serviceName)
                    ->view('emails.non_subscribed_todo_notification')
                    ->attach($this->invoicePath, [
                        'as' => 'bon_de_commande.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}
