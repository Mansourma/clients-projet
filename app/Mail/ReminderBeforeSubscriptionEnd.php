<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderBeforeSubscriptionEnd extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $serviceName;
    public $dueDate;
    public $enterpriseName;
    public $companyName;
 
    /**
     * Create a new message instance.
     *
     * @param string $clientName
     * @param string $enterpriseName
     * @param string $serviceName
     * @param string $dueDate
     * @return void
     */
    public function __construct($clientName, $enterpriseName, $serviceName, $dueDate)
    {
        $this->clientName = $clientName;
        $this->enterpriseName = $enterpriseName;
        $this->serviceName = $serviceName;
        $this->dueDate = $dueDate;
        $this->companyName = 'Ryd MEDIATECH';

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reminder: Your Subscription Ends Soon')
                    ->view('emails.ReminderBeforeSubscriptionEnd')
                    ->with([
                        'clientName' => $this->clientName,
                        'enterpriseName' => $this->enterpriseName,
                        'serviceName' => $this->serviceName,
                        'dueDate' => $this->dueDate,
                        'companyName' => $this->companyName,

                    ]);
    }
}
