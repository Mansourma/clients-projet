<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use App\Mail\NonSubscribedToDoNotification;

class NonSubscribedServiceOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:non-subscribed-service-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification emails to non-subscribed clients with scheduled services';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $services = Service::where('is_subscription', 0)
                         ->where('services_status', 'to do')
                         ->get();

        foreach ($services as $service) {
            $client = $service->client;
            $invoicePath = Storage::disk('public')->path('orders/bon_de_commande_' . $service->client_id . '.pdf');

            if (file_exists($invoicePath)) {
                Mail::to($client->email_client)->send(new NonSubscribedToDoNotification(
                    $client->name_client,
                    $service->service_name,
                    $invoicePath
                ));
            } else {
                \Log::error('Invoice file not found: ' . $invoicePath);
            }
        }
    }
}
