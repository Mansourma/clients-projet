<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SubscriptionConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $serviceName;
    public $companyName;
    public $invoicePath;
    public $invoiceNumber;
    public $clientType;
    public $enterpriseName;


    /**
     * Create a new message instance.
     *
     * @param string $clientName
     * @param string $serviceName
     * @param string $invoicePath
     * @param string $invoiceNumber
     * @param string $clientType
     * @param string $enterpriseName
     * @return void
     */
    public function __construct($clientName, $serviceName, $invoicePath, $invoiceNumber, $clientType, $enterpriseName = null)
    {
        $this->clientName = $clientName;
        $this->serviceName = $serviceName;
        $this->invoiceNumber = $invoiceNumber;
        $this->clientType = $clientType;
        $this->enterpriseName = $enterpriseName;
        $this->invoicePath = Storage::disk('public')->path('invoices/invoice_' . $this->invoiceNumber . '.pdf');
        $this->companyName = 'Ryd MEDIATECH';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        \Log::info('Building email');

        $view = 'emails.subscription_confirmed';
        $data = [
            'serviceName' => $this->serviceName,
            'invoiceNumber' => $this->invoiceNumber,
            'clientName' => $this->clientName,
            'clientType' => $this->clientType,
            'companyName' => $this->companyName,
            'enterpriseName' => $this->enterpriseName,
            ];

        \Log::info('Rendering view: ' . $view);
        $renderedView = view($view, $data)->render();
        \Log::info('View rendered. Length: ' . strlen($renderedView));

        $email = $this->subject('Service Validated - ' . $this->serviceName)
            ->view($view, $data);

        \Log::info('Attempting to attach file: ' . $this->invoicePath);

        if (file_exists($this->invoicePath)) {
            \Log::info('File exists. Filesize: ' . filesize($this->invoicePath) . ' bytes');
            try {
                $email->attach($this->invoicePath, [
                    'as' => 'invoice_' . $this->invoiceNumber . '.pdf',
                    'mime' => 'application/pdf',
                ]);
                \Log::info('File attached successfully');
            } catch (\Exception $e) {
                \Log::error('Error attaching file: ' . $e->getMessage());
            }
        } else {
            \Log::error('Invoice file not found: ' . $this->invoicePath);
        }

        return $email;
    }
}
