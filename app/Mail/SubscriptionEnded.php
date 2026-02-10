<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionEnded extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $serviceName;
    public $companyName;
    public $clientType;
    public $enterpriseName;


    /**
     * Create a new message instance.
     *
     * @param string $clientName
     * @param string $serviceName
     * @param string $clientType
     * @param string $enterpriseName
     * @return void
     */
    public function __construct($clientName, $serviceName, $clientType, $enterpriseName = null)
    {
        $this->clientName = $clientName;
        $this->serviceName = $serviceName;
        $this->clientType = $clientType;
        $this->enterpriseName = $enterpriseName;
        $this->companyName = 'Ryd MEDIATECH';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Subscription Ended - ' . $this->serviceName)
                    ->view('emails.subscription_ended')
                    ->with([
                        'clientName' => $this->clientName,
                        'serviceName' => $this->serviceName,
                        'companyName' => $this->companyName,
                        'clientType' => $this->clientType,
                        'enterpriseName' => $this->enterpriseName,
                    ]);
    }
}
