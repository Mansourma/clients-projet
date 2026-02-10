<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddClient extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $companyName;
    public $clientType;
    public $legalRepresentativeName;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($clientName, $clientType, $legalRepresentativeName = null)
    {
        $this->clientName = $clientName;
        $this->clientType = $clientType;
        $this->legalRepresentativeName = $legalRepresentativeName;
        $this->companyName = 'Ryd MEDIATECH';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to ' . $this->companyName)
                    ->view('emails.client_added')
                    ->with([
                        'clientName' => $this->clientName,
                        'companyName' => $this->companyName,
                        'clientType' => $this->clientType,
                        'legalRepresentativeName' => $this->legalRepresentativeName,

                    ]);
    }
}
