<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderAfterSubscriptionEnd extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $serviceName;
    public $enterpriseName;
    public $companyName;


    /**
     * Create a new message instance.
     *
     * @param string $clientName
     * @param string $enterpriseName
     * @param string $serviceName
     * @return void
     */
    public function __construct($clientName, $enterpriseName, $serviceName)
    {
        $this->clientName = $clientName;
        $this->enterpriseName = $enterpriseName;
        $this->serviceName = $serviceName;
        $this->companyName = 'Ryd MEDIATECH';
            }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Warning: Your Subscription Has Ended')
                    ->view('emails.after_subscription_end')
                    ->with([
                        'clientName' => $this->clientName,
                        'enterpriseName' => $this->enterpriseName,
                        'serviceName' => $this->serviceName,
                        'companyName' => $this->companyName,

                    ]);
    }
}
