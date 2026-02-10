<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderBeforePaymentDue extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $enterpriseName;
    public $serviceName;
    public $dueDate;
    public $companyName;


    public function __construct($clientName, $enterpriseName, $serviceName, $dueDate)
    {
        $this->clientName = $clientName;
        $this->enterpriseName = $enterpriseName;
        $this->serviceName = $serviceName;
        $this->dueDate = $dueDate;
        $this->companyName = 'Ryd MEDIATECH';
       
    }

    public function build()
    {
        return $this->subject('Upcoming Payment Reminder')
                    ->view('emails.reminder_before_payment_due')
                    ->with([
                        'clientName' => $this->clientName,
                        'enterpriseName' => $this->enterpriseName,
                        'serviceName' => $this->serviceName,
                        'dueDate' => $this->dueDate,
                        'companyName' => $this->companyName,
                    ]);
    }
}
